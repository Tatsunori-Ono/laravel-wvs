<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

// ゲストユーザー向けのルート
Route::middleware('guest')->group(function () {
    // ユーザー登録ページの表示
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    // ユーザー登録の処理
    Route::post('register', [RegisteredUserController::class, 'store']);

    // ログインページの表示
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    // ログインの処理
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // パスワードリセットリンクの要求ページの表示
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    // パスワードリセットリンクの送信処理
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    // パスワードリセットページの表示
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    // パスワードリセットの処理
    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

// 認証済みユーザー向けのルート
Route::middleware('auth')->group(function () {
    // メールアドレス確認ページの表示
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    // メールアドレス確認の処理
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    // メール確認通知の再送信処理
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    // パスワード確認ページの表示
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    // パスワード確認の処理
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    // パスワード変更の処理
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    // ログアウトの処理
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
