<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $headers = file(storage_path('app\factories_content\events\headers.txt'), FILE_IGNORE_NEW_LINES);
        $contents = file(storage_path('app\factories_content\events\contents.txt'), FILE_IGNORE_NEW_LINES);   

        if (count($headers) <= count($contents)) {
            $index = array_rand($headers);
        }
        else {
            $index = array_rand($contents);
        }

        return [
            'header' => $headers[$index],
            'content' => $contents[$index],
        ];
    }
}
