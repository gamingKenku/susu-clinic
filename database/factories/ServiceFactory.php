<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names = file(storage_path('app\factories_content\services\names.txt'), FILE_IGNORE_NEW_LINES);

        return [
            'name' => $names[array_rand($names)],
            'price' => fake()->randomFloat(2, 1, 2000),
        ];
    }
}
