<?php

namespace Database\Seeders;

use Database\Factories\ClinicFactory;
use App\Models\Clinic;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClinicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Clinic::factory()
            ->count(2)
            ->has(Category::factory()
                ->count(9)
                ->has(Service::factory()
                    ->count(5)))
            ->create();
    }
}
