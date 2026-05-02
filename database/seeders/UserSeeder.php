<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data Admin
        User::updateOrCreate(
            ['email' => 'admin@example.com'], // Kolom unik sebagai kunci pencarian
            [
                'name' => 'Admin',
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ]
        );

        // Data User Ardian
        User::updateOrCreate(
            ['email' => 'ardian@example.com'],
            [
                'name' => 'Ardian',
                'username' => 'ardian',
                'password' => Hash::make('password'),
                'role' => 'user',
                'phone_number' => '081234567890',
            ]
        );
    }
}