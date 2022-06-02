<?php

use PTC\Classes\Validator\Rules;

return [
    "slug" => ['required',"callback" => Rules::unique(\PTC\App\Model\Slug::class,"slug")],
    "target_link" => ['required'],
];