<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clinic>
 */
class ClinicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names = file(storage_path('app\factories_content\clinics\names.txt'), FILE_IGNORE_NEW_LINES);

        return [
            'name' => $names[array_rand($names)],
            'address' => fake()->address(),
        ];
    }
}
