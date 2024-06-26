<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Google2FALaravel\Support\Authenticator;
use Illuminate\Support\Facades\Auth;

class TwoFactorController extends Controller
{
    public function index()
    {
        return view('google2fa.index');
    }

    public function verify(Request $request)
    {
        $authenticator = app(Authenticator::class)->boot($request);

        if ($authenticator->isAuthenticated()) {
            return redirect()->intended('dashboard');
        }

        return redirect()->route('2fa')->withErrors(['one_time_password' => 'The provided 2FA code is incorrect.']);
    }
}
