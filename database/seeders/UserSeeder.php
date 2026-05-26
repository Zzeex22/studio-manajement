<?php

namespace Database\Seeders;

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
        // 1. Akun Admin (Bisa lihat semua, termasuk keuangan)
        User::create([
            'name' => 'Admin Studio',
            'email' => 'admin@studio.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // 2. Akun Partner (Bisa lihat proyek dan laporan)
        User::create([
            'name' => 'Partner Bisnis',
            'email' => 'partner@studio.com',
            'password' => Hash::make('password123'),
            'role' => 'partner',
        ]);

        // 3. Akun Designer (Bisa lihat tugas/brief desain aja)
        User::create([
            'name' => 'Designer Grafis',
            'email' => 'designer@studio.com',
            'password' => Hash::make('password123'),
            'role' => 'designer',
        ]);
    }
}