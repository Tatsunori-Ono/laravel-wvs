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
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = User::create([
            'name' => 'user',
            'role' => 'user',
            'email' => 'tatsunori.no1@gmail.com',
            'password' => Hash::make('user')
        ]);

        $admin = User::create([
            'name' => 'admin',
            'role' => 'admin',
            'warwick_id' => '5513312',
            'email' => 'tatsunorionoastroid@gmail.com',
            'password' => Hash::make('admin')
        ]);

        // Seed some contact forms for each user
        ContactForm::create([
            'name' => 'Sample Inquiry User',
            'email' => 'sampleuser@example.com',
            'non_warwick_student' => 0,
            'subject' => 'Sample Inquiry Subject',
            'contact' => 'This is a sample inquiry for a regular user.',
            'user_id' => $user->id, // Linking to user
        ]);

        ContactForm::create([
            'name' => 'Sample Inquiry Admin',
            'email' => 'sampleadmin@example.com',
            'non_warwick_student' => 0,
            'subject' => 'Sample Inquiry Subject for Admin',
            'contact' => 'This is a sample inquiry for an admin.',
            'user_id' => $admin->id, // Linking to admin
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
