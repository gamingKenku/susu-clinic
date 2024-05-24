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
        $headers = file(storage_path('app\factories_content\discounts\headers.txt'), FILE_IGNORE_NEW_LINES);
        $contents = file(storage_path('app\factories_content\discounts\contents.txt'), FILE_IGNORE_NEW_LINES);   

        if (count($headers) <= count($contents)) {
            $index = array_rand($headers);
        }
        else {
            $index = array_rand($contents);
        }

        return [
            'header' => $headers[$index],
            'markup' => $contents[$index],
            'start_date' => Carbon::now()->subDays(rand(1, 14)),
            'end_date' => Carbon::now()->addDays(rand(1, 14))
        ];
    }
}
