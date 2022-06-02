<?php

namespace MazaresServeces\Database\Seed;

use MazaresServeces\App\Model\Role;

class DataBaseSeeder
{
    public function seeders(): void
    {
        PermissionSeeder::Seed();
        RoleSeeder::Seed();
        UserSeeder::Seed();
    }
}