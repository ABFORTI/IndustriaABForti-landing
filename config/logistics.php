<?php

return [

    'companies' => [
        'upperlogistics' => [
            'name' => 'UpperLogistics',
            'tag' => 'Red logística nacional',
            'description' => 'Nos especializamos en ofrecer soluciones de almacenaje a la medida, espacios de almacenamiento seguro y centros de distribución de alta tecnología',
            'accent' => 'logistica',
            'accent_soft' => 'logistica-soft',
            'icon' => 'truck',
            'logo' => 'logo/upper-logo.png',
            'traits' => ['Centros de trabajo propios', 'Sectores industriales', 'Segmentos Automotriz y Retail', 'Conexiones logísticas nacionales'],
            'reference' => 'https://upperlogistics.mx/',
        ],
        'controlup' => [
            'name' => 'Control Up Logistics',
            'tag' => 'Especialista dentro del ecosistema',
            'description' => 'Empresa especializada del mismo ecosistema logístico: comparte las capacidades generales de la red bajo un enfoque de atención dedicada.',
            'accent' => 'controlup',
            'accent_soft' => 'controlup-soft',
            'icon' => 'shield',
            'logo' => 'logo/controlUp-logo.png',
            'traits' => ['3PL', 'Agencia aduanal', 'Desconsolidación', 'Cross Docking', 'Flete terrestre'],
            'reference' => null,
        ],
    ],

    'services' => [
        ['key' => '3pl', 'icon' => 'layers', 'label' => '3PL', 'description' => 'Gestión externalizada de almacenaje, inventario y distribución de punta a punta.', 'image' => 'img/upper-card.webp'],
        ['key' => 'aduanal', 'icon' => 'stamp', 'label' => 'Agencia aduanal', 'description' => 'Trámites y cumplimiento aduanero para que la carga cruce frontera sin fricción.', 'image' => 'img/upper/backgroundU.webp'],
        ['key' => 'desconsolidacion', 'icon' => 'boxes', 'label' => 'Desconsolidación', 'description' => 'Separación de carga consolidada en envíos individuales listos para distribución.', 'image' => 'img/upper-card.webp'],
        ['key' => 'crossdocking', 'icon' => 'shuffle', 'label' => 'Cross Docking', 'description' => 'La mercancía cambia de transporte sin pasar por almacenaje, reduciendo tiempos.', 'image' => 'img/upper/backgroundU.webp'],
        ['key' => 'flete', 'icon' => 'truck', 'label' => 'Flete terrestre', 'description' => 'Transporte terrestre propio y aliado hacia cualquier punto de la red nacional.', 'image' => 'img/upper-card.webp'],
    ],

    'work_centers' => [
        'edomex' => [
            'company' => 'controlup',
            'sector' => 'Industrial y distribución',
            'segments' => ['Automotriz', 'Retail'],
            'services' => ['3pl', 'crossdocking', 'flete'],
            'point' => ['x' => 580.7, 'y' => 453.9],
        ],
        'cdmx' => [
            'company' => 'upperlogistics',
            'sector' => 'Operaciones y servicios empresariales',
            'segments' => ['Retail'],
            'services' => ['3pl', 'aduanal', 'flete'],
            'point' => ['x' => 597.2, 'y' => 460],
        ],
        'queretaro' => [
            'company' => 'upperlogistics',
            'sector' => 'Centro estratégico',
            'segments' => ['Automotriz', 'Retail'],
            'services' => ['3pl', 'crossdocking', 'flete'],
            'point' => ['x' => 578.5, 'y' => 411.3],
            'size_m2' => 21000,
        ],
        'guadalajara' => [
            'company' => 'upperlogistics',
            'sector' => 'Almacenamiento y distribución',
            'segments' => ['Automotriz', 'Retail'],
            'services' => ['3pl', 'desconsolidacion', 'flete'],
            'point' => ['x' => 468, 'y' => 422.9],
            'size_m2' => 5000,
        ],
        'manzanillo' => [
            'company' => 'upperlogistics',
            'sector' => 'Conexión portuaria',
            'segments' => ['Retail'],
            'services' => ['aduanal', 'desconsolidacion', 'crossdocking'],
            'point' => ['x' => 460.4, 'y' => 463.1],
            'size_m2' => 2000,
            'port' => true,
        ],
    ],

    // Centros sin coordenada en el mapa interactivo todavía: se muestran
    // como chip informativo dentro de la tarjeta de su empresa.
    'extra_work_centers' => [
        'upperlogistics' => [
            ['city' => 'Cuautitlán', 'size_m2' => 5000],
        ],
    ],


    'network_points' => [
        'monterrey' => ['label' => 'Monterrey', 'state' => 'Nuevo León', 'state_svg_id' => 'MXNLE', 'type' => 'connection', 'point' => ['x' => 571.1, 'y' => 248.2]],
        'villahermosa' => ['label' => 'Villahermosa', 'state' => 'Tabasco', 'state_svg_id' => 'MXTAB', 'type' => 'connection', 'point' => ['x' => 785.1, 'y' => 496.6]],
        'tijuana' => ['label' => 'Tijuana', 'state' => 'Baja California', 'state_svg_id' => 'MXBCN', 'type' => 'origin', 'point' => ['x' => 119.2, 'y' => 58.9]],
        'pacifico' => ['label' => 'Ruta marítima', 'state' => 'Océano Pacífico', 'state_svg_id' => null, 'type' => 'sea', 'point' => ['x' => 340, 'y' => 520]],
    ],


    'routes' => [
        [
            'id' => 'maritima-manzanillo',
            'label' => 'Ruta marítima — Manzanillo',
            'description' => 'La mercancía llega por vía marítima al puerto de Manzanillo y continúa por tierra hacia Guadalajara y la red de centros.',
            'mode' => 'sea',
            'waypoints' => ['point:pacifico', 'center:manzanillo', 'center:guadalajara'],
        ],
        [
            'id' => 'nuevo-leon',
            'label' => 'Ruta desde Nuevo León',
            'description' => 'Carga que entra por el norte del país y se integra a la red logística hacia el centro de trabajo en Ciudad de México.',
            'mode' => 'land',
            'waypoints' => ['point:monterrey', 'center:cdmx'],
        ],
        [
            'id' => 'tijuana',
            'label' => 'Ruta desde Tijuana',
            'description' => 'Carga del noroeste que se conecta con Manzanillo y de ahí con el resto de la red logística.',
            'mode' => 'land',
            'waypoints' => ['point:tijuana', 'center:manzanillo'],
        ],
    ],

];
