<?php

namespace Database\Seeders;

use App\Models\ContactForm;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * データベースのシーディングを実行します。
     * Seed the application's database.
     */
    public function run(): void
    {
        // シーダークラスを呼び出す
        $this->call([
            TestSeeder::class,
            UserSeeder::class,
            EquipmentItemsTableSeeder::class,
            ShowcaseSeeder::class,
        ]);

        // 連絡先フォームデータを15件生成する
        ContactForm::factory(15)->create();

        // テストユーザーデータを生成する
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
