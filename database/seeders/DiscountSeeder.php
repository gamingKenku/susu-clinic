<?php

namespace Database\Seeders;

use App\Models\Discount;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Discount::factory()
            ->count(5)
            ->create()
            ->each(function ($discount) {
                $services = Service::inRandomOrder()->take(rand(1, 3))->pluck('id');

                $discount->services()->attach($services);
            });
    }
}
