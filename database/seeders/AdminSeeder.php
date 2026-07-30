<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::updateOrCreate(
            ['email' => 'admin@grocery.com'],
            [
                'name' => 'Store Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Create Regular User
        User::updateOrCreate(
            ['email' => 'user@grocery.com'],
            [
                'name' => 'Normal Customer',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]
        );
    }
}
