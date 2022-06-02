<?php

return [
    'name' => 'required',
    'email' => 'required|email',
    'password' => 'required|min:6',
    'confirm_password' => 'required|same:password',
    'avatar' => 'required|uploaded_file:0,500K,png,jpeg',
    'skills' => 'array',
    'skills.*.id' => 'required|numeric',
    'skills.*.percentage' => 'required|numeric'
];
