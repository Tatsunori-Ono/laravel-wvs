<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TestController;
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Session;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/events', function () {
    return view('events');
});

Route::get('/showcase', function () {
    return view('showcase');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/recyclable-boxes', function () {
    return view('recyclable-boxes');
});

Route::get('/', function () {
    return redirect('/about');
});

// 言語設定変更のルート
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ja'])) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('change_language');

Route::get('tests/test', [TestController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';