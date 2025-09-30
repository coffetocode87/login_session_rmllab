<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'), // password = "password"
            'role' => 'admin',
        ]);

        // User biasa
        User::create([
            'name' => 'Regular User',
            'email' => 'user@mail.com',
            'password' => Hash::make('password'), // password = "password"
            'role' => 'user',
        ]);
    }
}
