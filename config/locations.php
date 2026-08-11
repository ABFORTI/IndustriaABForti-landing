<?php

/**
 * Ubicaciones del mapa interactivo de México (BRIEF §5, §12, §22).
 *
 * Estructura de datos pedida explícitamente por el BRIEF ("no hardcodear
 * toda la información directamente dentro del HTML"). Consumida por el
 * componente de mapa (Fase 3) y por la sección de cobertura (Fase 6).
 *
 * `divisions`: slugs de config/divisions.php que operan en esa ubicación
 *   — tal como los lista el ejemplo de la sección 22 del BRIEF.
 * `highlights`: los textos exactos que la sección 5 del BRIEF pide mostrar
 *   en el tooltip de cada ubicación (pueden incluir términos que no son
 *   nombres de división, p. ej. "Centro estratégico").
 *
 * `state_svg_id` corresponde al id de estado (formato "MXxxx") usado en
 * resources/svg/mexico-map.svg (fuente: simplemaps.com, free for commercial
 * use — ver encabezado del propio archivo). El componente de mapa
 * (Fase 3) namespacea estos ids por instancia y distingue el <path> del
 * estado del <circle> de su centroide (grupo "label_points" del SVG).
 */

return [

    [
        'slug' => 'edomex',
        'city' => 'Estado de México',
        'state' => 'Estado de México',
        'state_svg_id' => 'MXMEX',
        'divisions' => ['logistica'],
        'highlights' => ['Logística', 'Distribución', 'Conectividad'],
    ],

    [
        'slug' => 'cdmx',
        'city' => 'Ciudad de México',
        'state' => 'Ciudad de México',
        'state_svg_id' => 'MXCMX',
        'divisions' => ['logistica'],
        'highlights' => ['Operaciones', 'Servicios empresariales'],
    ],

    [
        'slug' => 'queretaro',
        'city' => 'Querétaro',
        'state' => 'Querétaro',
        'state_svg_id' => 'MXQUE',
        'divisions' => ['industria', 'logistica'],
        'highlights' => ['Industria', 'Logística', 'Centro estratégico'],
    ],

    [
        'slug' => 'guadalajara',
        'city' => 'Guadalajara',
        'state' => 'Jalisco',
        'state_svg_id' => 'MXJAL',
        'divisions' => ['logistica'],
        'highlights' => ['Logística', 'Almacenamiento', 'Distribución'],
    ],

    [
        'slug' => 'manzanillo',
        'city' => 'Manzanillo',
        'state' => 'Colima',
        'state_svg_id' => 'MXCOL',
        'divisions' => ['logistica'],
        'highlights' => ['Logística', 'Conexión portuaria', 'Distribución'],
    ],

];
