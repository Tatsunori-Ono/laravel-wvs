<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use PragmaRX\Google2FALaravel\Google2FA;
use PragmaRX\Google2FALaravel\Support\Authenticator;

class ProfileController extends Controller
{
    /**
     * ユーザーのプロフィールフォームを表示する。
     * Display the user's profile form.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * ユーザーのプロフィール情報を更新する。
     * Update the user's profile information.
     *
     * @param \App\Http\Requests\ProfileUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // プロフィール写真が提供された場合の更新
        // Update profile photo if provided
        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('profile-icons', 'public');
            $user->profile_photo_path = $path;
        }

        // 2FA設定の更新
        // Update 2FA settings
        $google2fa = app('pragmarx.google2fa');
        if ($request->is_enable_google2fa) {
            $user->google2fa_secret = $google2fa->generateSecretKey();
            $user->is_enable_google2fa = true;
        } else {
            $user->google2fa_secret = null;
            $user->is_enable_google2fa = false;
        }

        // 他のユーザー情報の更新
        // Update other user information
        $user->fill($request->safe()->only(['name', 'email']));

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * ユーザーのアカウントを削除する。
     * Delete the user's account.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
