<?php

namespace Database\Seeders;

use App\Models\ContactForm;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TestSeeder::class,
            UserSeeder::class,
            EquipmentItemsTableSeeder::class,
            ShowcaseSeeder::class,
        ]);

        ContactForm::factory(15)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
