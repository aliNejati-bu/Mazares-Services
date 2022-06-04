<?php

namespace MazaresServices\Database\Seed;

use MazaresServices\App\Model\Role;

class DataBaseSeeder
{
    public function seeders(): void
    {
        PermissionSeeder::Seed();
        RoleSeeder::Seed();
        UserSeeder::Seed();
    }
}