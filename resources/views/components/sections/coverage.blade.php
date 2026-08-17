@php
    $extraCenters = config('logistics.extra_work_centers', []);
    $locations = collect(config('locations'))->keyBy('slug');
    $sites = collect(config('logistics.work_centers'))
        ->filter(fn ($center) => !empty($center['size_m2']))
        ->map(fn ($center, $slug) => [
            'city' => $locations[$slug]['city'] ?? $slug,
            'sqm' => $center['size_m2'],
        ])
        ->values();

    foreach ($extraCenters as $extras) {
        foreach ($extras as $extra) {
            if (!empty($extra['size_m2'])) {
                $sites->push(['city' => $extra['city'], 'sqm' => $extra['size_m2']]);
            }
        }
    }

    $totalSqm = $sites->sum('sqm');
    $cityCount = $sites->pluck('city')->unique()->count();
    $hasPort = collect(config('logistics.work_centers'))->contains('port', true);
    $largestSite = $sites->sortByDesc('sqm')->first();

    $stats = [
        [
            'icon' => 'building',
            'value' => number_format($totalSqm, 0, '.', ',') . ' m²',
            'label' => 'En operación a nivel nacional',
        ],
        [
            'icon' => 'pin',
            'value' => $cityCount . ' ciudades',
            'label' => 'Con centro de trabajo propio',
        ],
        [
            'icon' => 'anchor',
            'value' => $hasPort ? 'Sí' : 'No',
            'label' => 'Conexión portuaria integrada a la red',
        ],
        [
            'icon' => 'truck',
            'value' => $largestSite ? number_format($largestSite['sqm'], 0, '.', ',') . ' m²' : '—',
            'label' => $largestSite ? 'Nuestra sede más grande, en ' . $largestSite['city'] : 'Sede más grande',
        ],
    ];
@endphp

<section class="py-16 sm:py-20">
    <div class="container-grid flex flex-col gap-10">
        <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-[0_20px_60px_-30px_rgba(23,24,28,0.25)]">
            <iframe
                src="{{ asset('mapa_logistico_marketing/index.html') }}"
                title="Mapa logístico de presencia física"
                class="block h-[520px] w-full border-0 sm:h-[600px]"
                loading="lazy"
            ></iframe>
        </div>
        

        <x-ui.section-heading
            eyebrow="Escala del grupo"
            title="Presencia física, no solo promesas."
            subtitle="Metros cuadrados de almacenaje y operación por sede, en tiempo real desde nuestra red logística."
        />

        <div data-reveal class="grid grid-cols-2 gap-4 lg:grid-cols-4 lg:gap-6">
            @foreach ($stats as $index => $stat)
                <div
                    style="--reveal-delay: {{ $index * 80 }}ms"
                    class="flex flex-col gap-3 rounded-2xl border border-gray-200 p-5 sm:p-6"
                >
                    <x-ui.icon :name="$stat['icon']" class="h-6 w-6 text-logistica" />
                    <span class="font-display text-2xl font-bold text-carbon sm:text-3xl">{{ $stat['value'] }}</span>
                    <span class="text-xs leading-snug text-gray-500 sm:text-sm">{{ $stat['label'] }}</span>
                </div>
            @endforeach
        </div>

        <x-sections.infrastructure-stats :sites="$sites->all()" accent="logistica" instance-id="coverage-map" />
    </div>
</section>
