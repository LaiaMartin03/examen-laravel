<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            ['name' => 'Admin', 'password' => Hash::make('123456')]
        );
        User::firstOrCreate(
            ['email' => 'olga@gmail.com'],
            ['name' => 'Olga', 'password' => Hash::make('123456')]
        );
        User::firstOrCreate(
            ['email' => 'laia@gmail.com'],
            ['name' => 'Laia', 'password' => Hash::make('123456')]
        );
        User::firstOrCreate(
            ['email' => 'prueba@gmail.com'],
            ['name' => 'Prueba', 'password' => Hash::make('123456')]
        );
    }
}
