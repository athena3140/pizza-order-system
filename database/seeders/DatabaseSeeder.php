<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'gender' => 'male',
            'phone' => '12345678',
            'address' => '512 Hangover St',
            'role' => 'admin',
            'password' => Hash::make('admin'),
        ]);

        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'gender' => 'female',
            'phone' => '12345678',
            'address' => '512 Hangover St',
            'role' => 'user',
            'password' => Hash::make('user'),
        ]);
    }
}
