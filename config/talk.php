<?php

return [
    'user' => [
        'model' => 'App\Models\User',
    ],
    'broadcast' => [
        'enable'   => false,
        'app_name' => 'your-app-name',
        'pusher'   => [
            'app_id'     => '',
            'app_key'    => '',
            'app_secret' => '',
        ],
    ],
];
