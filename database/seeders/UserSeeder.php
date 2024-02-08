<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!User::query()->where('username', '=', 'test')->exists()) {
            User::create([
                'username' => 'test',
                'password' => Hash::make('12345'),
                'email' => 'test@mail.ru',
                'first_name' => 'first_name',
                'last_name' => 'last_name',
            ]);
        }
    }
}
