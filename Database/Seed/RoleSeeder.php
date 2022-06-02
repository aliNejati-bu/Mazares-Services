<?php

namespace PTC\Database\Seed;

use PTC\App\Model\Role;

class RoleSeeder
{
    public static function Seed()
    {
        $roles = [
            ["role_name" => "userManager",
            "permissions" => [1]],
        ];
        foreach ($roles as $role){
            $r = Role::create(["role_name"=>$role["role_name"]]);
            $r->permissions()->attach($role["permissions"]);
        }
    }
}