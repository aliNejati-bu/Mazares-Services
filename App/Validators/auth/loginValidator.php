<?php

use MazaresServeces\App\Model\User;
use MazaresServeces\Classes\Validator\Rules;

return [
    "email" => ['required', 'email', 'min:3'],
    "password" => ['required', 'min:8'],
    "isLong"=> ["default:0","required"]
];