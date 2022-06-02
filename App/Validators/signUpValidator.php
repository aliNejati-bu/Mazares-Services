<?php

use PTC\App\Model\User;
use PTC\Classes\Validator\Rules;

return [
    "user_email" => ['required', 'email', 'min:3',"callback" => Rules::unique(User::class, "user_email")],
    "password" => ['required', 'min:8'],
    "name" => ['required', "min:3"]
];