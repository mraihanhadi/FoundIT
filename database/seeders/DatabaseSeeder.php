<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin FoundIT',
            'username' => 'admin',
            'email' => 'admin@foundit.ac.id',
            'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Standard User
        User::create([
            'name' => 'Kevin Liu',
            'username' => 'KevinKece22',
            'email' => 'KevinLiu@gmail.com',
            'no_telp' => '08123456789',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'user',
        ]);
    }
}
