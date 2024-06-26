<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     * ファクトリが使用している現在のパスワード
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     * モデルのデフォルト状態の定義
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(15), // 名前
            'email' => fake()->unique()->safeEmail(), // メールアドレス
            'email_verified_at' => now(), // メール検証日時
            'password' => static::$password ??= Hash::make('password'), // パスワード
            'remember_token' => Str::random(10), // リメンバートークン
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     * モデルのメールアドレスが未検証であることを示す
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null, // メール検証日時をnullに設定
        ]);
    }
}
