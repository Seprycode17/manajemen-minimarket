<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Supplier; // <-- Tambahkan ini
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User Akun Default
        User::create([
            'name' => 'Admin Minimarket',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Petugas Toko',
            'email' => 'petugas@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'petugas',
        ]);

        // Tambahkan Supplier Default di Sini
        Supplier::create([
            'name' => 'PT. Sumber Alfaria Trijaya',
            'phone' => '081234567890',
            'address' => 'Jl. Industri Raya No. 10, Jakarta',
        ]);

        Supplier::create([
            'name' => 'PT. Unilever Indonesia',
            'phone' => '082198765432',
            'address' => 'Kawasan Industri Jababeka, Bekasi',
        ]);
    }
}