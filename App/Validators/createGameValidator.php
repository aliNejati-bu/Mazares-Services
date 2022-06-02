<?php


use MazaresServeces\App\Model\Game;
use MazaresServeces\Classes\Validator\Rules;

return [
    "game_name" => ['required', 'alpha_spaces', 'min:3', 'max:100'],
    "packagename" => ['required', 'string','min:3', 'max:100', Rules::unique(Game::class, "packagename")],
];