<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Discount>
 */
class DiscountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'header' => fake()->sentence(),
            'markup' => fake()->text(),
            'start_date' => Carbon::now()->subDays(rand(1, 14)),
            'end_date' => Carbon::now()->addDays(rand(1, 14))
        ];
    }
}
