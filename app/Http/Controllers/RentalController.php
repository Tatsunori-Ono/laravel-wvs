<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EquipmentItem;
use App\Models\EquipmentImage;
use App\Models\CartItem;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
{
    /**
     * 機材の一覧を表示する。
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category');
        $favorites = $request->input('favorites');

        $equipmentItems = EquipmentItem::query()
            ->when($search, function ($query) use ($search) {
                return $query->where('product_name', 'like', '%' . $search . '%')
                    ->orWhere('category', 'like', '%' . $search . '%')
                    ->orWhere('manufacturer', 'like', '%' . $search . '%');
            })
            ->when($category, function ($query) use ($category) {
                return $query->where('category', $category);
            })
            ->when($favorites && Auth::check(), function ($query) {
                return $query->whereHas('favoritedBy', function ($query) {
                    $query->where('user_id', Auth::id());
                });
            })
            ->paginate(12);

        $cartItemCount = CartItem::where('user_id', Auth::id())->count();

        $categories = EquipmentItem::select('category')->distinct()->pluck('category');

        return view('rental.index', compact('equipmentItems', 'cartItemCount', 'categories'));
    }

    /**
     * 新しい機材の作成フォームを表示する。
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('rental.index')->with('error', 'You do not have permission to create an item.');
        }

        return view('rental.create');
    }

    /**
     * 新しく作成された機材をストレージに保存する。
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('rental.index')->with('error', 'You do not have permission to create an item.');
        }

        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_type' => 'required|string|max:255',
            'manufacturer' => 'nullable|string|max:255',
            'category' => 'required|string|max:255',
            'location_stored' => 'required|string|max:255',
            'description' => 'nullable|string',
            'purchase_date' => 'nullable|date',
            'quantity' => 'required|integer',
            'max_rental_days' => 'required|integer',
            'price' => 'required|numeric',
            'images' => 'nullable|array|max:9',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $equipmentItem = EquipmentItem::create($request->all());

        if ($request->has('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('equipment_images', 'public');
                $equipmentItem->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('rental.index')->with('success', 'Equipment item created successfully.');
    }

    /**
     * 指定された機材を表示する。
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $equipmentItem = EquipmentItem::with('images')->findOrFail($id);
        $isFavorited = Auth::check() && Auth::user()->favorites()->where('equipment_item_id', $id)->exists();

        return view('rental.show', compact('equipmentItem', 'isFavorited'));
    }

    /**
     * 指定された機材の編集フォームを表示する。
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'You do not have permission to edit this item.');
        }

        $equipmentItem = EquipmentItem::findOrFail($id);
        return view('rental.edit', compact('equipmentItem'));
    }

    /**
     * 指定された機材をストレージに更新する。
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'You do not have permission to update this item.');
        }

        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_type' => 'required|string|max:255',
            'manufacturer' => 'nullable|string|max:255',
            'category' => 'required|string|max:255',
            'location_stored' => 'required|string|max:255',
            'description' => 'nullable|string',
            'purchase_date' => 'nullable|date',
            'quantity' => 'required|integer',
            'max_rental_days' => 'required|integer',
            'price' => 'required|numeric',
            'images' => 'nullable|array|max:9',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $equipmentItem = EquipmentItem::findOrFail($id);
        $equipmentItem->update($request->all());

        // 選択された画像を消す
        // Remove selected images
        if ($request->has('remove_images')) {
            foreach ($request->input('remove_images') as $imageId) {
                $image = EquipmentImage::findOrFail($imageId);
                $image->delete();
            }
        }

        // 新しく画像を追加する
        // Add new images
        if ($request->has('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('equipment_images', 'public');
                $equipmentItem->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('rental.index')->with('success', 'Equipment item updated successfully.');
    }

    /**
     * 指定された機材をストレージから削除する。
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'You do not have permission to destroy this item.');
        }

        $equipmentItem = EquipmentItem::findOrFail($id);

        // Delete associated images
        foreach ($equipmentItem->images as $image) {
            $image->delete();
        }

        $equipmentItem->delete();

        return redirect()->route('rental.index')->with('success', 'Equipment item deleted successfully.');
    }

    /**
     * 指定されたアイテムをお気に入りに追加する。
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addToFavorites($id)
    {
        $user = Auth::user();
        $user->favorites()->attach($id);

        return redirect()->route('rental.show', $id)->with('success', 'Item added to favorites.');
    }

    /**
     * 指定されたアイテムをお気に入りから削除する。
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeFromFavorites($id)
    {
        $user = Auth::user();
        $user->favorites()->detach($id);

        return redirect()->route('rental.show', $id)->with('success', 'Item removed from favorites.');
    }
}

