<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Position>
 */
class PositionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names = file(storage_path('app\factories_content\positions\names.txt'), FILE_IGNORE_NEW_LINES);

        return [
            'name' => $names[array_rand($names)],
            'description' => fake()->text(),
            'responsibilities' => fake()->text(),
            'requirements' => fake()->text(),
            'conditions' => fake()->text(),
            'has_vacancy' => fake()->boolean(),
        ];
    }
}
