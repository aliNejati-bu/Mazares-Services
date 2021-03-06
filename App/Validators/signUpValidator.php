<?php

use MazaresServices\App\Model\User;
use MazaresServices\Classes\Validator\Rules;

return [
    "user_email" => ['required', 'email', 'min:3',"callback" => Rules::unique(User::class, "user_email")],
    "password" => ['required', 'min:8'],
    "name" => ['required', "min:3"]
];