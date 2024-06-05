<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // get user with ID of 1 (Admin)
        $user = User::find(1);

        // Assign roles to the user
        $user->syncRoles('Admin');
    }
}
