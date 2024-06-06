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
        $adminUser = User::find(1);
        $academicHeadUser = User::find(2);
        $teacherUser = User::find(3);
        $std1User = User::find(4);
        $std2User = User::find(5);

        // Assign roles to the user
        $adminUser->syncRoles('Admin');
        $academicHeadUser->syncRoles('Academic Head');
        $teacherUser->syncRoles('Teacher');
        $std1User->syncRoles('Student');
        $std2User->syncRoles('Student');
    }
}
