<?php

return [
    'bridge_ip' => env('ALERTER_BRIDGE_IP'),
    'bridge_username' => env('ALERTER_BRIDGE_USERNAME'),
    'calendar' => env('ALERTER_BRIDGE_CALENDAR'),
    'lights' => explode(',', (string)env('ALERTER_LIGHTS')),
    'colors' => [
        'green' => '#00d100',
        'orange' => '#ffa000',
        'blue' => '#007ed8',
    ],
    'alerts' => [
        'gft' => 'green',
        'rest' => 'green',
        'pmd' => 'orange',
        'papier' => 'blue',
    ],
];
