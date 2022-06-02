<?php


use MazaresServeces\App\Model\App;
use MazaresServeces\Classes\Validator\Rules;

return [
    "app_name" => ['required', 'alpha_spaces', 'min:3', 'max:100'],
    "packagename" => ['required', 'string','min:3', 'max:100', Rules::unique(App::class, "packagename")],
];