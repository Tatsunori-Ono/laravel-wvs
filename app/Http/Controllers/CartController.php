<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\EquipmentItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'equipment_item_id' => 'required|exists:equipment_items,id',
            'quantity' => 'required|integer|min:1',
            'rental_days' => 'required|integer|min:1|max:' . EquipmentItem::find($request->equipment_item_id)->max_rental_days,
        ]);

        $equipmentItem = EquipmentItem::findOrFail($request->equipment_item_id);
        $availableQuantity = $equipmentItem->quantity - $equipmentItem->rented_quantity;

        if ($request->quantity > $availableQuantity) {
            return back()->with('error', 'Not enough items available.');
        }

        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('equipment_item_id', $request->equipment_item_id)
            ->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $request->quantity;
            if ($newQuantity > $availableQuantity) {
                return back()->with('error', 'Not enough items available.');
            }
            $cartItem->quantity = $newQuantity;
            $cartItem->rental_days = $request->rental_days; // Update rental days
            $cartItem->save();
        } else {
            if ($request->quantity > $availableQuantity) {
                return back()->with('error', 'Not enough items available.');
            }
            CartItem::create([
                'user_id' => Auth::id(),
                'equipment_item_id' => $request->equipment_item_id,
                'quantity' => $request->quantity,
                'rental_days' => $request->rental_days, // Set rental days
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Item added to cart.');
    }

    public function remove($id)
    {
        $cartItem = CartItem::where('user_id', Auth::id())->where('id', $id)->firstOrFail();
        $cartItem->delete();

        return back()->with('success', 'Item removed from cart.');
    }

    public function index()
    {
        $cartItems = CartItem::where('user_id', Auth::id())->with('equipmentItem')->get();
        return view('cart.index', compact('cartItems'));
    }

    public function update(Request $request, $id)
    {
        $cartItem = CartItem::where('user_id', Auth::id())->where('id', $id)->firstOrFail();

        $request->validate([
            'rental_days' => 'required|integer|min:1|max:' . $cartItem->equipmentItem->max_rental_days,
        ]);

        $cartItem->rental_days = $request->rental_days;
        $cartItem->save();

        return back()->with('success', 'Rental days updated.');
    }
}
