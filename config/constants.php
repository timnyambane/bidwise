<?php

return [
    'roles' => ['admin', 'customer', 'business'],
    'job_types' => ['premium', 'standard'],
    'urgencies' => ['flexible', 'specificDate', 'immediately'],

    'country_code' => '44',

    'job_status' => [
        'active' => 'active',
        'in_progress' => 'in_progress',
        'completed' => 'completed',
        'cancelled' => 'cancelled',
    ],

    'accountType' => [
        'customer' => 'customer',
        'business' => 'business',
        'admin' => 'admin'
    ],

    'job_urgency' => [
        'specificDate' => 'specificDate',
        'immediately' => 'immediately',
        'flexible' => 'flexible',
    ]
];