<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => '123@admin',
        ]);

        // Academic head
        User::create([
            'name' => 'Academic Head',
            'email' => 'head@gmail.com',
            'password' => '123@head',
        ]);


        // Teacher
        User::create([
            'name' => 'Nuwan Silva',
            'email' => 'nuwan@gmail.com',
            'password' => '123@nuwan',
        ]);


        // Student 1 -> 2023
        User::create([
            'name' => 'Amaln Fernando',
            'email' => 'amal@gmail.com',
            'password' => '123@amal',
        ]);

        // Student 2 -> 2024
        User::create([
            'name' => 'Kamal Perera',
            'email' => 'kamal@gmail.com',
            'password' => '123@kamal',
        ]);
    }
}
