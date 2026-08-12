@props(['division'])

@php

    $locationsBySlug = collect(config('locations'))->keyBy('slug');
    $workCenters = config('logistics.work_centers');
    $networkPoints = config('logistics.network_points');
    $routes = config('logistics.routes');
    $companies = config('logistics.companies');
    $servicesByKey = collect(config('logistics.services'))->keyBy('key');

    $mapLocations = [];

    foreach ($workCenters as $slug => $center) {
        $base = $locationsBySlug->get($slug);

        if (! $base) {
            continue;
        }

        $company = $companies[$center['company']] ?? null;

        $mapLocations[] = [
            'slug' => $slug,
            'city' => $base['city'],
            'state' => $base['state'],
            'state_svg_id' => $base['state_svg_id'],
            'highlights' => $base['highlights'],
            'type' => 'center',
            // Paleta simplificada del mapa (no la de división): centro =
            // naranja, origen = azul oscuro, conexión/flujo = gris.
            'accent' => 'logistics-center',
            'meta' => [
                'city' => $base['city'],
                'state' => $base['state'],
                'company' => $company['name'] ?? null,
                'sector' => $center['sector'],
                'segments' => $center['segments'],
                'services' => collect($center['services'])
                    ->map(fn ($key) => $servicesByKey[$key]['label'] ?? $key)
                    ->values()->all(),
            ],
        ];
    }

    foreach ($networkPoints as $slug => $point) {
        if ($point['type'] === 'sea') {
            continue; // solo se usa como punto de paso al dibujar la ruta marítima
        }

        $mapLocations[] = [
            'slug' => $slug,
            'city' => $point['label'],
            'state' => $point['state'],
            'state_svg_id' => $point['state_svg_id'],
            'highlights' => [$point['type'] === 'origin' ? 'Origen de carga' : 'Nodo de conexión'],
            'type' => $point['type'],
            'accent' => $point['type'] === 'origin' ? 'logistics-origin' : 'logistics-flow',
            'point' => $point['point'],
        ];
    }

    // Rutas resueltas a coordenadas concretas (espacio del viewBox 0 0 1000 630)
    // para el overlay SVG animado (BRIEF §5).
    $resolvedRoutes = collect($routes)->map(function ($route) use ($workCenters, $networkPoints) {
        $points = collect($route['waypoints'])->map(function ($waypoint) use ($workCenters, $networkPoints) {
            [$kind, $key] = explode(':', $waypoint, 2);

            return $kind === 'center' ? $workCenters[$key]['point'] : $networkPoints[$key]['point'];
        })->values()->all();

        return [
            'id' => $route['id'],
            'label' => $route['label'],
            'description' => $route['description'],
            'mode' => $route['mode'],
            'points' => $points,
        ];
    })->values();
@endphp

<section id="red-logistica" class="scroll-mt-24 bg-gray-50/60 py-16 sm:py-20">
    <div class="container-grid flex flex-col gap-8">
        <x-ui.section-heading
            eyebrow="Red logística"
            title="Así se mueve la carga dentro de la red"
            subtitle="Selecciona un centro de trabajo para ver su empresa, sector y segmentos. Las líneas muestran cómo llegan las cargas desde distintos orígenes."
        />

        {{-- Leyenda visual (BRIEF §14): 3 colores, sin flechas — centro
        (naranja), origen (azul oscuro), flujo (gris), para que se lea de
        un vistazo sin saturar el mapa. --}}
        <div class="flex flex-wrap items-center gap-x-6 gap-y-3 text-xs text-gray-600 sm:text-sm">
            <span class="inline-flex items-center gap-2">
                <span class="h-2.5 w-2.5 rounded-full" style="background: var(--color-logistics-center)"></span>
                Centro logístico
            </span>
            <span class="inline-flex items-center gap-2">
                <svg class="h-3 w-5" viewBox="0 0 20 12" aria-hidden="true"><line x1="0" y1="6" x2="20" y2="6" stroke="var(--color-logistics-flow)" stroke-width="2" stroke-dasharray="4 3" stroke-linecap="round" /></svg>
                Flujo terrestre
            </span>
            <span class="inline-flex items-center gap-2">
                <svg class="h-3 w-5" viewBox="0 0 20 12" aria-hidden="true"><line x1="0" y1="6" x2="20" y2="6" stroke="var(--color-logistics-flow)" stroke-width="2" stroke-dasharray="1 4" stroke-linecap="round" /></svg>
                Flujo marítimo
            </span>
            <span class="inline-flex items-center gap-2">
                <span class="h-2.5 w-2.5 rounded-full border-2" style="border-color: var(--color-logistics-origin)"></span>
                Origen de carga
            </span>
        </div>

        <div data-logistics-map-root class="relative -mx-4 rounded-2xl border border-gray-100 bg-white p-2 shadow-[0_20px_60px_-30px_rgba(23,24,28,0.25)] sm:mx-0 sm:rounded-3xl sm:p-6">
            <x-map.mexico-map instance-id="logistica-network" :locations="$mapLocations" />

            {{-- Sin flechas: solo la línea de flujo (BRIEF §14), para que el
            mapa se lea limpio y no sobrecargado. --}}
            <svg
                class="pointer-events-none absolute inset-0 h-full w-full"
                viewBox="0 0 1000 630"
                preserveAspectRatio="xMidYMid meet"
                aria-hidden="true"
                data-logistics-routes
            ></svg>

            {{-- Panel contextual: drawer en desktop, hoja inferior en mobile (BRIEF §6, §12) --}}
            <div data-logistics-drawer-backdrop class="logistics-drawer-backdrop" aria-hidden="true"></div>

            <aside
                data-logistics-drawer
                class="logistics-drawer"
                aria-hidden="true"
                aria-label="Detalle del centro de trabajo"
            >
                <button type="button" data-logistics-drawer-close class="logistics-drawer__close" aria-label="Cerrar">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                        <path d="M6 6l12 12M18 6L6 18" />
                    </svg>
                </button>

                <span class="logistics-drawer__eyebrow" data-drawer-company></span>
                <h3 class="logistics-drawer__title" data-drawer-city></h3>
                <p class="logistics-drawer__sector" data-drawer-sector></p>

                <div class="logistics-drawer__group">
                    <span class="logistics-drawer__label">Segmentos</span>
                    <div class="logistics-drawer__tags" data-drawer-segments></div>
                </div>

                <div class="logistics-drawer__group">
                    <span class="logistics-drawer__label">Servicios en este centro</span>
                    <div class="logistics-drawer__tags" data-drawer-services></div>
                </div>
            </aside>

            <script type="application/json" data-logistics-routes-data>{!! json_encode($resolvedRoutes, JSON_UNESCAPED_UNICODE) !!}</script>
        </div>
    </div>
</section>
