<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Models\Staff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Position::factory()
            ->count(10)
            ->create()
            ->each(function ($position) {
                $staff = Staff::inRandomOrder()->take(rand(1, 3))->pluck('id');

                $position->staff()->attach($staff);
            });
    }
}
