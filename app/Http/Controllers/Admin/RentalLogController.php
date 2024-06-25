<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rental;

use Illuminate\Support\Facades\Auth;

class RentalLogController extends Controller
{
    /**
     * Display a listing of the rental logs.
     */
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to visit admin page.');
        }

        $rentals = Rental::with('user', 'equipmentItem')->paginate(10);

        return view('admin.rentals.index', compact('rentals'));
    }

    /**
     * Show the form for editing the specified rental.
     */
    public function edit($id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to visit admin page.');
        }

        $rental = Rental::with('user', 'equipmentItem')->findOrFail($id);
        return view('admin.rentals.edit', compact('rental'));
    }

    /**
     * Update the specified rental in storage.
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to visit admin page.');
        }

        $request->validate([
            'quantity' => 'required|integer|min:1',
            'return_by' => 'required|date',
        ]);

        $rental = Rental::findOrFail($id);
        $rental->update($request->all());

        return redirect()->route('admin.rental.log')->with('success', 'Rental updated successfully.');
    }

    /**
     * Remove the specified rental from storage.
     */
    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to visit admin page.');
        }

        $rental = Rental::findOrFail($id);
        $rental->delete();

        return redirect()->route('admin.rental.log')->with('success', 'Rental deleted successfully.');
    }

    /**
     * Cancel the specified rental and revive the stock.
     */
    public function cancel($id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to visit the admin page.');
        }

        $rental = Rental::findOrFail($id);

        // Increase the stock of the equipment item
        $equipmentItem = $rental->equipmentItem;
        $equipmentItem->quantity += $rental->quantity;
        $equipmentItem->save();

        // Delete the rental log
        $rental->delete();

        return redirect()->route('admin.rental.log')->with('success', 'Rental log has been canceled and stock has been updated.');
    }
}
