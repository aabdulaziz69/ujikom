<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Kodirin',
            'username' => 'kodir',
            'email' => 'kodirin@example.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Kasmansyah',
            'username' => 'kasman',
            'email' => 'kasmansyah@example.com',
            'password' => Hash::make('12345678'),
            'role' => 'petugas',
        ]);
    }
}
