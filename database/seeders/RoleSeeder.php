<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Staff;
use App\Models\WorkingHours;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::factory()
            ->count(3)
            ->has(Staff::factory()
                ->count(5)
                ->has(WorkingHours::factory()
                    ->count(1)))
            ->create();
    }
}
