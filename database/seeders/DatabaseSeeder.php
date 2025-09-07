<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // NO truncate/delete code! migrate:fresh already handles this
        $this->call([
            RolePermissionSeeder::class,
        ]);
        $this->call(RolePermissionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(categorieseeder::class);
        $this->call(ProfileSeeder::class);
        $this->call(TaskSeeder::class);
    }
}
