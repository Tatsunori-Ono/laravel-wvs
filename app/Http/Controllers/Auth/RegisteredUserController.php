<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

use PragmaRX\Google2FALaravel\Support\Authenticator;

class RegisteredUserController extends Controller
{
    /**
     * 登録ビューを表示する。
     * Display the registration view.
     * 
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * 受信した登録リクエストを処理する。
     * Handle an incoming registration request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // ウォーリックIDは必ず7桁
            'warwick_id' => ['nullable', 'digits:7', 'unique:'.User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $google2fa = app('pragmarx.google2fa');
        $google2faSecret = "";
        $isEnableGoogle2fa = $request->has('is_enable_google2fa') ? $request->is_enable_google2fa : false;

        $user = User::create([
            'name' => $request->name,
            'warwick_id' => $request->warwick_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'google2fa_secret' => $google2faSecret,
            'is_enable_google2fa' => $isEnableGoogle2fa,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
