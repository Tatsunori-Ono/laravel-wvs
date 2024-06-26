<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Google2FALaravel\Support\Authenticator;
use Illuminate\Support\Facades\Auth;

class TwoFactorController extends Controller
{
    /**
     * 2FA認証画面を表示する
     * Display the 2FA verification view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('google2fa.index');
    }

    /**
     * ユーザーが入力した2FAを認証する
     * Verify the provided 2FA code.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(Request $request)
    {
        $authenticator = app(Authenticator::class)->boot($request);

        if ($authenticator->isAuthenticated()) {
            return redirect()->intended('dashboard');
        }

        return redirect()->route('2fa')->withErrors(['one_time_password' => 'The provided 2FA code is incorrect.']);
    }
}
