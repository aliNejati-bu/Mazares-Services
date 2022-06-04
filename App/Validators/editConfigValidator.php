<?php
return [
    "app_id" => ['required', 'numeric'],
    "config_id" => ['required', 'numeric'],
    "config_name" => ['required', 'alpha_dash', 'min:3', 'max:50'],
];