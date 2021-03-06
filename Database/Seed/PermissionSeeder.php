<?php

namespace MazaresServices\Database\Seed;

use MazaresServices\App\Model\Permission;

class PermissionSeeder
{
    public static function Seed(){
        $permissions = [
            [
                "permission_name" => "Users",
                "persian_name" => "کاربران"
            ],
        ];

        foreach ($permissions as $permission){
            Permission::create($permission);
        }
    }
}