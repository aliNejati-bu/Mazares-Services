<?php


use MazaresServices\App\Model\App;
use MazaresServices\Classes\Validator\Rules;

return [
    "app_name" => ['required', 'alpha_spaces', 'min:3', 'max:100'],
    "packagename" => ['required', 'string', 'min:3', 'max:100'],
    "app_id" => ['required', 'numeric'],
];