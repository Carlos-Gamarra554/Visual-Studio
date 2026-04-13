<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Boss',
            'email' => 'admin@api.com',
            'password' => Hash::make('password123'),
            'role' => 'administrador'
        ]);

        User::create([
            'name' => 'Normal User',
            'email' => 'user@api.com',
            'password' => Hash::make('password123'),
            'role' => 'usuario' 
        ]);
    }
}