<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\ContactForm;

class UserSeeder extends Seeder
{
    /**
     * データベースのシードを実行します。
     * Run the database seeds.
     */
    public function run(): void
    {
        // 一般ユーザー（メンバー）の作成
        $user = User::create([
            'name' => 'user',
            'role' => 'user',
            'email' => 'tatsunori.no1@gmail.com',
            'email_verified_at' => now(), // 開発用なのでメール認証はスキップ
            'password' => Hash::make('user'),
            'google2fa_secret' => null, // 開発用なので2FAは無効化
            'is_enable_google2fa' => false, // 開発用なので2FAは無効化
        ]);

        // アドミン（管理者）の作成
        $admin = User::create([
            'name' => 'admin',
            'role' => 'admin',
            'warwick_id' => '5513312',
            'email' => 'tatsunorionoastroid@gmail.com',
            'email_verified_at' => now(), // 開発用なのでメール認証はスキップ
            'password' => Hash::make('admin'),
            'google2fa_secret' => null, // 開発用なので2FAは無効化
            'is_enable_google2fa' => false, // 開発用なので2FAは無効化
        ]);

        // 各ユーザーのための問い合わせフォームのシード
        // Seed some contact forms for each user
        ContactForm::create([
            'name' => 'Sample Inquiry User',
            'email' => 'sampleuser@example.com',
            'non_warwick_student' => 0,
            'subject' => 'Sample Inquiry Subject',
            'contact' => 'This is a sample inquiry for a regular user.',
            'user_id' => $user->id, // ユーザーにリンク　Linking to user
        ]);

        ContactForm::create([
            'name' => 'Sample Inquiry Admin',
            'email' => 'sampleadmin@example.com',
            'non_warwick_student' => 0,
            'subject' => 'Sample Inquiry Subject for Admin',
            'contact' => 'This is a sample inquiry for an admin.',
            'user_id' => $admin->id, // 管理者にリンク　Linking to admin
        ]);

        // DB::table('users') -> insert([
        //     [
        //         'name' => 'user',
        //         'role' => 'user',
        //         'warwick_id' => null,
        //         'email' => 'tatsunori.no1@gmail.com',
        //         'password' => Hash::make('user')
        //     ],
        //     [
        //         'name' => 'admin',
        //         'role' => 'admin',
        //         'warwick_id' => '5513312',
        //         'email' => 'tatsunorionoastroid@gmail.com',
        //         'password' => Hash::make('admin')
        //     ],
        // ]);
    }
}
