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
     * Display a listing of the resource.
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rental.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation and storing logic
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $equipmentItem = EquipmentItem::with('images')->findOrFail($id);
        $isFavorited = Auth::check() && Auth::user()->favorites()->where('equipment_item_id', $id)->exists();

        return view('rental.show', compact('equipmentItem', 'isFavorited'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $equipmentItem = EquipmentItem::findOrFail($id);
        return view('rental.edit', compact('equipmentItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validation and updating logic
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Deleting logic
    }

    public function addToFavorites($id)
    {
        $user = Auth::user();
        $user->favorites()->attach($id);

        return redirect()->route('rental.show', $id)->with('success', 'Item added to favorites.');
    }

    public function removeFromFavorites($id)
    {
        $user = Auth::user();
        $user->favorites()->detach($id);

        return redirect()->route('rental.show', $id)->with('success', 'Item removed from favorites.');
    }
}

