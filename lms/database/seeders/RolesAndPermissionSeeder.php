<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $admin = Role::create(['name' => 'Admin']);
        $academicHead = Role::create(['name' => 'Academic Head']);
        $teacher = Role::create(['name' => 'Teacher']);
        $student = Role::create(['name' => 'Student']);

        // Create Permissions for users
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'delete user']);

        // Create Permissions for courses
        Permission::create(['name' => 'create course']);
        Permission::create(['name' => 'view course']);
        Permission::create(['name' => 'edit course']);
        Permission::create(['name' => 'delete course']);

        // Create Permissions for modules
        Permission::create(['name' => 'create module']);
        Permission::create(['name' => 'view module']);
        Permission::create(['name' => 'edit module']);
        Permission::create(['name' => 'delete module']);

        // Create Permissions for sudits
        Permission::create(['name' => 'view audit']);
        Permission::create(['name' => 'download audit']);

        // Assign Permission to role
        $admin->givePermissionTo(Permission::all());

        $academicHead->givePermissionTo([
            'create course', 'view course', 'edit course', 'delete course',
            'create module', 'view module', 'edit module', 'delete module'
        ]);

        $teacher->givePermissionTo([
            'view course',
            'view module',
        ]);

        $student->givePermissionTo([
            'view course',
            'view module',
        ]);
    }
}
