<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * リクエストを承認するかどうかを判断します。
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * リクエストに適用されるバリデーションルールを取得します。
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * リクエストの資格情報を使って認証を試みます。
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        // レート制限がかかっていないか確認
        $this->ensureIsNotRateLimited();

        // 認証を試みる
        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            // 認証失敗時、レートリミットをヒットさせる
            RateLimiter::hit($this->throttleKey());

            // 認証失敗メッセージを返す
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        // 認証成功時、レートリミットをクリア
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * ログインリクエストがレート制限を受けていないことを確認します。
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        // ロックアウトイベントを発生させる
        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        // レート制限メッセージを返す
        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * リクエストのレート制限キーを取得します。
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
