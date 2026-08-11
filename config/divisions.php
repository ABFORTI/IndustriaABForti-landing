<?php

return [

    'industria' => [
        'name' => 'Industria',
        'accent' => 'industria',
        'accent_soft' => 'industria-soft',
        'headline' => 'Transformamos necesidades industriales en soluciones reales.',
        'tagline' => 'En Innovet, somos especialistas en diseñar y fabricar piezas termoformadas que se ajustan a las necesidades particulares de cada industria.',
        'subheadline' => null,
        'cta_label' => 'Conocer Industria',
        'reference' => 'https://innovet.com.mx/',
        'visual_keywords' => ['Manufactura', 'Maquinaria', 'Piezas industriales', 'Ingeniería'],
        'icon' => 'cube',
        'logo' => 'logo/innovet-logo.png',
        'background_image' => 'img/background.webp',
        'capabilities' => [
            [
                'label' => 'Charolas',
                'image' => 'img/charola.webp',
                'advantages' => [
                    'Se diseña y fabrica para atender necesidades específicas.',
                    'Uso interno entre líneas de producción, traslado de piezas y entrega final. ',
                    'Piezas de un solo uso o retornables.',
                    'Diseños de estibas apilables para un manejo y almacenamiento eficiente.',
                ],
            ],
            [
                'label' => 'Blisters',
                'image' => 'img/blister.webp',
                'advantages' => [
                    'Garantiza la seguridad y preservación de tus productos desde la línea de producción hasta el almacenamiento y la entrega final.',
                    'Cada proyecto es único y se diseña y fabrica de manera exclusiva para satisfacer tus necesidades',
                    'Realza las características de tus productos en los puntos de venta, impulsando su atractivo visual',
                    'Mantén en perfecto estado y protegido contra daños y pérdidas.',
                ],
            ],
            [
                'label' => 'Clamshells',
                'image' => 'img/clamshell.webp',
                'advantages' => [
                    'Empaque tipo concha que permite ver el producto desde todos los ángulos.',
                    'Cierre a presión que facilita el empaque y desempaque sin herramientas.',
                    'Alta resistencia a la manipulación, ideal como protección antirrobo en retail.',
                    'Contenedores con dos o más secciones que se pliegan mediante una bisagra.',
                ],
            ],
        ],
        'industries_served' => [
            [
                'label' => 'Alimenticia',
                'icon' => 'food',
                'image' => 'img/industries/alimenticia.webp',
                'description' => 'Envases y charolas termoformadas que preservan frescura y cumplen normativas de contacto alimentario.',
            ],
            [
                'label' => 'Automotriz',
                'icon' => 'car',
                'image' => 'img/industries/automotriz.webp',
                'description' => 'Ayudan a prevenir daños durante el almacenamiento y el envío, lo que es crucial para mantener la calidad de las piezas.',
            ],
            [
                'label' => 'Agroindustrial',
                'icon' => 'leaf',
                'image' => 'img/industries/agroindustrial.webp',
                'description' => 'Ayudan a mantener la frescura y la integridad de los productos durante su distribución',
            ],
            [
                'label' => 'Electrónica',
                'icon' => 'chip',
                'image' => 'img/industries/electronica.webp',
                'description' => 'Ofrecen protección a componentes frágiles como placas de circuitos y chips. Su diseño personalizado garantiza un ajuste perfecto',
            ],
            [
                'label' => 'Retail',
                'icon' => 'bag',
                'image' => 'img/industries/retail.webp',
                'description' => 'Protegen y destacan el producto, asegurando su integridad y mejorando la experiencia del cliente en el punto de venta.',
            ],
            [
                'label' => 'Farmacéutica',
                'icon' => 'cross',
                'image' => 'img/industries/farmaceutica.webp',
                'description' => 'Proporcionan un empaque resistente a la humedad y a la contaminación.',
            ],
            [
                'label' => 'Cosmética',
                'icon' => 'droplet',
                'image' => 'img/industries/cosmetica.webp',
                'description' => 'Permiten un mayor cuidado y control sobre aquellos productos delicados.',
            ],
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
    
        'subheadline' => 'Desarrollamos proyectos empresariales llave en mano, integrando planeación, diseño, construcción y entrega bajo una misma visión.',
        'cta_label' => 'Conocer Inmobiliaria',
        'reference' => null,
        'visual_keywords' => ['Edificios', 'Parques industriales', 'Arquitectura', 'Infraestructura'],
        'icon' => 'building',

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
