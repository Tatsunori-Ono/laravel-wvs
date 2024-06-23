<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Rental;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        $rentals = Rental::where('user_id', Auth::id())->with('equipmentItem')->get();
        Log::info('Rentals fetched:', ['rentals' => $rentals]);

        return view('dashboard', compact('rentals'));
    }
}
