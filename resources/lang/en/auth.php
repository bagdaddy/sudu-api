<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'These credentials do not match our records.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
    'email' => [
        'required' => 'Email is required',
        'email' => 'Must enter a valid email',
        'unique' => 'This email already exists',
    ],
    'password' => [
        'required' => 'Password is required',
        'incorrect' => 'The provided password is incorrect.',
    ],
    'nickname' => [
        'required' => 'A username is required',
        'unique' => 'This username is already taken',
    ],
];
