<?php

use PTC\Classes\Validator\Rules;

return [
    "phone_number" => ['required',"callback" => Rules::iranPhoneNumber()],
];