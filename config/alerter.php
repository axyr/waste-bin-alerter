<?php

return [
    'bridge_ip' => env('ALERTER_BRIDGE_IP'),
    'bridge_username' => env('ALERTER_BRIDGE_USERNAME'),
    'lights' => explode(',', (string)env('ALERTER_LIGHTS')),
    'calendar' => env('ALERTER_BRIDGE_CALENDAR'),
    'colors' => [
        'green' => '#00d100',
        'orange' => '#ffa000',
        'blue' => '#005cff',
    ],
    'alerts' => [
        'gft' => 'green',
        'rest' => 'green',
        'pmd' => 'orange',
        'papier' => 'blue',
    ],
];
