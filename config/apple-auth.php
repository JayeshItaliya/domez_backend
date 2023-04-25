<?php

return [
    'client_id' => env('APPLE_CLIENT_ID'),
    'team_id' => env('APPLE_TEAM_ID'),
    'key_id' => env('APPLE_KEY_ID'),
    'private_key' => file_get_contents(env('APPLE_PRIVATE_KEY_PATH')),
    'redirect_uri' => env('APPLE_REDIRECT_URI'),
    'scope' => ['name', 'email'],
    'response_type' => 'code id_token',
    'response_mode' => 'form_post',
];
