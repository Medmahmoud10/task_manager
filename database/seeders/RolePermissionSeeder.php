<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {

        
        // Use firstOrCreate to avoid duplicates
        $adminRole = Role::firstOrCreate([
            'name' => 'admin'
        ], [
            'description' => 'Administrator with full access',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $userRole = Role::firstOrCreate([
            'name' => 'user'
        ], [
            'description' => 'Regular user with limited access',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Create permissions with firstOrCreate
        $permissions = [
            ['name' => 'manage_tasks', 'description' => 'Can manage tasks'],
            ['name' => 'manage_categories', 'description' => 'Can manage categories'],
            ['name' => 'manage_profiles', 'description' => 'Can manage profiles'],
            ['name' => 'manage_users', 'description' => 'Can manage users'],
            ['name' => 'view_reports', 'description' => 'Can view reports']
        ];

        foreach ($permissions as $permissionData) {
            Permission::firstOrCreate(
                ['name' => $permissionData['name']],
                array_merge($permissionData, [
                    'created_at' => now(),
                    'updated_at' => now()
                ])
            );
        }

        // Assign permissions (use sync to avoid duplicates)
        $adminRole->permissions()->sync(Permission::pluck('id'));
        $userRole->permissions()->sync(
            Permission::whereIn('name', ['manage_tasks', 'manage_categories'])->pluck('id')
        );
    }
}