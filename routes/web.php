<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\TestController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JukeboxController;
use App\Http\Controllers\ProfileController;

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

//非メンバー向けの連絡先
Route::get('/external-contact', function () {
    return view('external-contact');
});

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
});

Route::get('/terms-and-conditions', function () {
    return view('terms-and-conditions');
});

Route::prefix('contacts') //頭にcontactsをつける
    ->middleware(['auth', 'verified']) //認証と管理者権限
    ->name('contacts.') //ルート名
    ->controller(ContactFormController::class) //コントローラ指定
    ->group(function(){ //グループ化
        Route::get('/','index')->name('index'); //index名前付きルート
        Route::get('/create','create')->name('create'); //create名前付きルート
        Route::post('/','store')->name('store'); //store名前付きルート
        Route::get('/{id}', 'show')->name('show'); //show名前付きルート
        Route::get('/{id}/edit', 'edit')->name('edit'); //edit名前付きルート
        Route::post('/{id}', 'update')->name('update'); //update名前付きルート
        Route::post('/{id}/destroy', 'destroy')->name('destroy'); //destroy名前付きルート
});

Route::prefix('rental')
    ->middleware(['auth', 'verified'])
    ->name('rental.')
    ->controller(RentalController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}', 'show')->name('show');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/{id}', 'update')->name('update');
        Route::post('/{id}/destroy', 'destroy')->name('destroy');
        Route::post('/favorite/{id}', 'addToFavorites')->name('addFavorite');
        Route::post('/unfavorite/{id}', 'removeFromFavorites')->name('removeFavorite');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('cart')->name('cart.')
        ->controller(CartController::class)
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::post('/add', 'addToCart')->name('add');
            Route::delete('/remove/{id}', 'remove')->name('remove');
            Route::put('/update/{id}', 'update')->name('update');
        });
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
});

Route::middleware(['auth', 'verified', 'google2fa'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/donate', function () {
    return view('donate');
})->middleware(['auth', 'verified'])->name('donate');

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// アドミン機能をテストするルート
Route::get('/admin-test', function() {
    return 'You are an admin';
})->middleware('auth', 'admin');

Route::get('/jukebox', [JukeboxController::class, 'index'])->name('jukebox.index');
Route::post('/jukebox', [JukeboxController::class, 'store'])->name('jukebox.store');
Route::get('/jukebox/admin', [JukeboxController::class, 'admin'])->name('jukebox.admin');
Route::post('/jukebox/admin/play', [JukeboxController::class, 'play'])->name('jukebox.play');
Route::post('/jukebox/admin/pause', [JukeboxController::class, 'pause'])->name('jukebox.pause');
