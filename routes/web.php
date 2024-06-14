<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TestController;
use App\Http\Controllers\ContactFormController;

use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Session;

use App\Http\Controllers\JukeboxQueueController;

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

Route::prefix('contacts') //頭にcontactsをつける
    ->middleware(['auth']) //認証
    ->name('contacts.') //ルート名
    ->controller(ContactFormController::class) //コントローラ指定
    ->group(function(){ //グループ化
        Route::get('/','index')->name('index'); //名前付きルート
        Route::get('/create','create')->name('create');
        Route::post('/','store')->name('store');
        Route::get('/{id}', 'show')->name('show');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/{id}', 'update')->name('update');
        Route::post('/{id}/destroy', 'destroy')->name('destroy');
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

Route::get('/jukebox', function () {
    return view('jukebox');
});

Route::middleware('auth')->group(function () {
    Route::post('/queue', [JukeboxQueueController::class, 'addToQueue']);
    Route::get('/queue', [JukeboxQueueController::class, 'getQueue']);
    Route::post('/queue/play-next', [JukeboxQueueController::class, 'playNextVideo']);
});