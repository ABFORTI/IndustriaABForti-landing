<?php

/**
 * Divisiones del grupo (BRIEF §1, §6, §8-10, §16).
 *
 * Fuente única de verdad para navbar, rutas, tarjetas de "tres divisiones"
 * y páginas propias de cada división. `accent`/`accent_soft` son nombres de
 * tokens de color definidos en resources/css/app.css (@theme), no valores
 * hex directos, para no duplicar la paleta en dos lugares.
 *
 * `headline`/`tagline` son citas literales de las secciones 6, 8, 9 y 10 del
 * BRIEF.md — no contenido inventado. `tagline` es, en concreto, el texto de
 * la tarjeta de cada división en la sección 6 ("Tres divisiones, una misma
 * visión"); se reutiliza también como meta description de su página propia.
 * `visual_keywords` son los términos que la sección 6 pide transmitir
 * visualmente por división — se muestran como leyenda del placeholder de
 * imagen (BRIEF §23/§25: sin fotografía real todavía).
 */

return [

    'industria' => [
        'name' => 'Industria',
        'accent' => 'industria',
        'accent_soft' => 'industria-soft',
        'headline' => 'Transformamos necesidades industriales en soluciones reales.',
        'tagline' => 'Diseño y Manufactura de empaques técnicos.',
        'subheadline' => null,
        'cta_label' => 'Conocer Industria',
        'reference' => 'https://innovet.com.mx/',
        'visual_keywords' => ['Manufactura', 'Maquinaria', 'Piezas industriales', 'Ingeniería'],
        'icon' => 'cube',
        // BRIEF §8 — capacidades y sección "Industrias que atendemos".
        'capabilities' => [
            'Manufactura', 'Termoformado', 'Empaques', 'Soluciones personalizadas',
            'Diseño', 'Prototipos', 'Moldes', 'Herramientas', 'Soluciones para diferentes industrias',
        ],
        'industries_served' => [
            'Automotriz', 'Electrónica', 'Farmacéutica', 'Cosmética', 'Agroindustrial', 'Alimentaria', 'Retail',
        ],
    ],

    'logistica' => [
        'name' => 'Logística',
        'accent' => 'logistica',
        'accent_soft' => 'logistica-soft',
        'headline' => 'Movemos tu operación. Optimizamos tu cadena de suministro.',
        'tagline' => 'Soluciones de almacenamiento, transporte y gestión logística para mantener tu cadena de suministro en movimiento.',
        'subheadline' => null,
        'cta_label' => 'Conocer Logística',
        'reference' => 'https://upperlogistics.mx/',
        'visual_keywords' => ['Almacenes', 'Transporte', 'Distribución', 'Tecnología logística'],
        'icon' => 'truck',
        // BRIEF §9 — capacidades. Los m² de infraestructura viven en config/infrastructure.php.
        'capabilities' => [
            'Almacenaje', 'Transporte terrestre', 'Distribución', 'Logística interna',
            'Logística inversa', 'Última milla', 'Cross docking', 'Tecnología logística', 'WMS',
        ],
    ],

    'inmobiliaria' => [
        'name' => 'Inmobiliaria',
        'accent' => 'inmobiliaria',
        'accent_soft' => 'inmobiliaria-soft',
        'headline' => 'Tu proyecto. De la idea a la realidad.',
        'tagline' => 'Desarrollamos proyectos inmobiliarios empresariales llave en mano, desde la planeación hasta la entrega.',
        // Subheadline propio de la página (§10), distinto del texto de tarjeta (§6) de "tagline".
        'subheadline' => 'Desarrollamos proyectos empresariales llave en mano, integrando planeación, diseño, construcción y entrega bajo una misma visión.',
        'cta_label' => 'Conocer Inmobiliaria',
        'reference' => null,
        'visual_keywords' => ['Edificios', 'Parques industriales', 'Arquitectura', 'Infraestructura'],
        'icon' => 'building',
        // BRIEF §10 — proceso 01-06 y categorías de proyecto (placeholders, sin proyectos reales aún).
        'process' => [
            ['step' => '01', 'label' => 'Planeación'],
            ['step' => '02', 'label' => 'Diseño'],
            ['step' => '03', 'label' => 'Ingeniería'],
            ['step' => '04', 'label' => 'Construcción'],
            ['step' => '05', 'label' => 'Equipamiento'],
            ['step' => '06', 'label' => 'Entrega'],
        ],
        'project_placeholders' => [
            'Parques industriales', 'Centros de distribución', 'Naves industriales',
            'Edificios corporativos', 'Infraestructura empresarial',
        ],
    ],

];
