<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rental;

use Illuminate\Support\Facades\Auth;

class RentalLogController extends Controller
{
    /**
     * レンタルログの一覧を表示する。
     * Display a listing of the rental logs.
     * 
     * @return \Illuminate\View\View | \Illuminate\Http\RedirectResponse
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
     * 指定されたレンタルの編集フォームを表示する。
     * Show the form for editing the specified rental.
     * 
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
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
     * 指定されたレンタルを更新する。
     * Update the specified rental in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
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
     * 指定されたレンタルを削除する。
     * Remove the specified rental from storage.
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
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
     * 指定されたレンタルをキャンセルし、在庫を復活させる。
     * Cancel the specified rental and revive the stock.
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel($id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to visit the admin page.');
        }

        $rental = Rental::findOrFail($id);

        // 備品アイテムの在庫を増やす
        // Increase the stock of the equipment item
        $equipmentItem = $rental->equipmentItem;
        $equipmentItem->quantity += $rental->quantity;
        $equipmentItem->save();

        // レンタルログを削除する
        // Delete the rental log
        $rental->delete();

        return redirect()->route('admin.rental.log')->with('success', 'Rental log has been canceled and stock has been updated.');
    }
}
