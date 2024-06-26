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
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
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
        if (!is_null($request->is_enable_google2fa)) {
            $google2faSecret = $google2fa->generateSecretKey();
        }

        $user = User::create([
            'name' => $request->name,
            'warwick_id' => $request->warwick_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'google2fa_secret' => $google2faSecret,
            'is_enable_google2fa' => $request->is_enable_google2fa,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
