<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staff>
 */
class StaffFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'patronym' => fake()->firstNameMale(),
            'specialities' => fake()->text(),
            'experience' => fake()->dateTime(),
            'staff_type' => Arr::random(['doctor', 'nurse', 'administrator']),
        ];
    }
}
