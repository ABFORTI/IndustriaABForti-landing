<?php

return [
    'companies' => [
        'ab-forti' => [
            'label' => 'AB Forti (Corporativo)',
            'email' => env('CONTACT_AB_FORTI', 'soporte@ab-forti.com'),
        ],
        'innovet' => [
            'label' => 'Innovet (Industria)',
            'email' => env('CONTACT_INNOVET', 'desarrollo@ab-forti.com'),
        ],
        'upperlogistics' => [
            'label' => 'Upper Logistics (Logística)',
            'email' => env('CONTACT_UPPER_LOGISTICS', 'correo@upperlogistics.com'),
        ],
        'controlup' => [
            'label' => 'Control Up Logistics (Logística)',
            'email' => env('CONTACT_CONTROL_UP', 'correo@upperlogistics.com'),
        ],
    ],

    'corporate_email' => env('CONTACT_AB_FORTI', 'soporte@ab-forti.com'),

    'division_map' => [
        'industria' => 'innovet',
        'logistica' => 'upperlogistics',
    ],

];
