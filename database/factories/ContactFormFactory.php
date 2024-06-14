<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactForm>
 */
class ContactFormFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jpFaker = \Faker\Factory::create('ja_JP');

        return [
            'name' => $jpFaker->name(20),
            'email' => $jpFaker->email(),
            'non_warwick_student' => $jpFaker->boolean(),
            'subject' => $jpFaker->realText(50),
            'contact' => $jpFaker->realText(200),
        ];
    }
}
