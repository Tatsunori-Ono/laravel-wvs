<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestSeeder extends Seeder
{
    /**
     * データベースのシードを実行します。
     * Run the database seeds.
     */
    public function run(): void
    {
        // testsテーブルにデータを挿入
        DB::table('tests') -> insert([
            [
                'text' => 'xxx',
                'created_at' => Now()
            ],
            [
                'text' => 'yyy',
                'created_at' => Now()
            ],
        ]);
    }
}
