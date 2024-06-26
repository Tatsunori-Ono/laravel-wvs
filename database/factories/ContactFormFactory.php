<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactForm>
 */
class ContactFormFactory extends Factory
{
    /**
     * モデルのデフォルト状態を定義する。
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // 日本語のフェイカーを作成
        $jpFaker = \Faker\Factory::create('ja_JP');

        return [
            // フェイカーを使用してデータを生成
            'name' => $jpFaker->name(20), // 名前
            'email' => $jpFaker->email(), // メールアドレス
            'non_warwick_student' => $jpFaker->boolean(), // 非ワーウィック学生かどうか
            'subject' => $jpFaker->realText(50), // 件名
            'contact' => $jpFaker->realText(200), // 問い合わせ内容
        ];
    }
}
