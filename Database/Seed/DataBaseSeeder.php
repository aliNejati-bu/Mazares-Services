<?php

namespace PTC\Database\Seed;

use PTC\App\Model\Role;

class DataBaseSeeder
{
    public function seeders(): void
    {
        PermissionSeeder::Seed();
        RoleSeeder::Seed();
        UserSeeder::Seed();
    }
}