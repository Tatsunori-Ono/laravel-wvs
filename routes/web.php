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
use App\Http\Controllers\ShowcaseController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RentalLogController;
use App\Http\Controllers\TwoFactorController;

use PragmaRX\Google2FALaravel\Middleware;
use PragmaRX\Google2FALaravel\Middleware as Google2FAMiddleware;

// ウェルカムページのルート
Route::get('/welcome', function () {
    return view('welcome');
});

// 認証、メール認証、2FAミドルウェアをグループに適用
Route::middleware(['auth', 'verified', Middleware::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/2fa', [TwoFactorController::class, 'index'])->name('2fa');
    Route::post('/2fa', [TwoFactorController::class, 'verify'])->name('2fa');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Aboutページのルート
Route::get('/about', function () {
    return view('about');
});

// Eventsページのルート
Route::get('/events', function () {
    return view('events');
});

// Showcaseページのルート
Route::get('/showcase', [ShowcaseController::class, 'index'])->name('showcase.index');

// 登録が必要なShowcase関連のルート
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/showcase/create', [ShowcaseController::class, 'create'])->name('showcase.create');
    Route::post('/showcase', [ShowcaseController::class, 'store'])->name('showcase.store');
    Route::get('/showcase/admin', [ShowcaseController::class, 'admin'])->name('showcase.admin');
    Route::post('/showcase/approve/{id}', [ShowcaseController::class, 'approve'])->name('showcase.approve');
    Route::post('/showcase/reject/{id}', [ShowcaseController::class, 'reject'])->name('showcase.reject');
    Route::get('/showcase/{id}/edit', [ShowcaseController::class, 'edit'])->name('showcase.edit');
    Route::patch('/showcase/{id}', [ShowcaseController::class, 'update'])->name('showcase.update');
    Route::delete('/showcase/{id}', [ShowcaseController::class, 'destroy'])->name('showcase.destroy');
    Route::delete('/showcase/work/{id}', [ShowcaseController::class, 'deleteFile'])->name('showcase.deleteFile');
});

// 非メンバー向けの連絡先ページのルート
Route::get('/external-contact', function () {
    return view('external-contact');
});

// プライバシーポリシーページのルート
Route::get('/privacy-policy', function () {
    return view('privacy-policy');
});

// 利用規約ページのルート
Route::get('/terms-and-conditions', function () {
    return view('terms-and-conditions');
});

// Contactフォームのルート
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

// レンタル関連のルート
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

// カート関連のルート
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

// 寄付ページのルート
Route::get('/donate', function () {
    return view('donate');
})->middleware(['auth', 'verified'])->name('donate');

// ルートディレクトリにアクセスした場合、/aboutにリダイレクト
Route::get('/', function () {
    return redirect('/about');
});

// 2FAミドルウェアを使用するダッシュボード関連のルート
Route::middleware(['auth', 'verified', Google2FAMiddleware::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// 言語設定変更のルート
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ja'])) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('change_language');

// テスト用のルート
Route::get('tests/test', [TestController::class, 'index']);

// 認証が必要なプロフィール関連のルート
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// ジュークボックス関連のルート
Route::get('/jukebox', [JukeboxController::class, 'index'])->name('jukebox.index');
Route::post('/jukebox', [JukeboxController::class, 'store'])->name('jukebox.store');
Route::get('/jukebox/admin', [JukeboxController::class, 'admin'])->name('jukebox.admin');
Route::post('/jukebox/admin/play', [JukeboxController::class, 'play'])->name('jukebox.play');
Route::post('/jukebox/admin/pause', [JukeboxController::class, 'pause'])->name('jukebox.pause');
Route::delete('/jukebox/{id}', [JukeboxController::class, 'destroy'])->name('jukebox.destroy');

// 管理者専用のルート
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Rental Log Routes
    Route::get('rental-log', [RentalLogController::class, 'index'])->name('rental.log');
    Route::get('rental-log/{id}/edit', [RentalLogController::class, 'edit'])->name('rental.edit');
    Route::patch('rental-log/{id}', [RentalLogController::class, 'update'])->name('rental.update');
    Route::delete('rental-log/{id}', [RentalLogController::class, 'destroy'])->name('rental.destroy');
    Route::post('rental-log/{id}/cancel', [RentalLogController::class, 'cancel'])->name('rental.cancel');
});