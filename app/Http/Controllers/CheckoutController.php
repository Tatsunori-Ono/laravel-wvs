<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Rental;
use App\Models\EquipmentItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::where('user_id', Auth::id())->with('equipmentItem')->get();
        return view('checkout.index', compact('cartItems'));
    }

    public function process(Request $request)
    {
        $cartItems = CartItem::where('user_id', Auth::id())->with('equipmentItem')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        DB::transaction(function () use ($cartItems) {
            foreach ($cartItems as $cartItem) {
                $rental = Rental::create([
                    'user_id' => Auth::id(),
                    'equipment_item_id' => $cartItem->equipment_item_id,
                    'quantity' => $cartItem->quantity,
                    'rental_days' => $cartItem->rental_days,
                    'return_by' => now()->addDays($cartItem->rental_days),
                ]);

                $equipmentItem = $cartItem->equipmentItem;
                $equipmentItem->rented_quantity += $cartItem->quantity;
                $equipmentItem->save();

                $cartItem->delete();
            }
        });

        return redirect()->route('dashboard')->with('success', 'Checkout successful. Your rental period has started.');
    }
}
