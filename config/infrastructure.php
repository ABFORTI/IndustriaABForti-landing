<?php

/**
 * Infraestructura física de la división Logística (BRIEF §9): metros
 * cuadrados por sede, citados literalmente del brief. Es un dataset
 * distinto de config/locations.php — "Cuautitlán" aparece aquí pero no es
 * uno de los 5 puntos del mapa interactivo, tal como los da el brief.
 *
 * "Estos datos deben presentarse como indicadores visuales de
 * infraestructura, no simplemente como texto" — se consumen desde
 * components/sections/infrastructure-stats.blade.php como barras
 * proporcionales, no como una lista plana.
 */

return [
    ['city' => 'Querétaro', 'sqm' => 21000],
    ['city' => 'Cuautitlán', 'sqm' => 5000],
    ['city' => 'Guadalajara', 'sqm' => 5000],
    ['city' => 'Manzanillo', 'sqm' => 2000],
];
