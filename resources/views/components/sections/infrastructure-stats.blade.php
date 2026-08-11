@props(['sites', 'accent'])

@php
    $max = max(array_column($sites, 'sqm'));
@endphp

{{-- BRIEF §9: infraestructura como indicador visual, no como texto plano.
     Las barras arrancan en 0 y crecen hasta su ancho real al hacer scroll
     (BRIEF §17: "counters", "line animations") — ver resources/js/counters.js. --}}
<section class="py-16">
    <div class="container-grid flex flex-col gap-10">
        <x-ui.section-heading
            eyebrow="Infraestructura"
            title="Presencia física del grupo"
            subtitle="Metros cuadrados de almacenaje y operación por sede."
        />

        <div class="flex flex-col gap-5">
            @foreach ($sites as $index => $site)
                @php $percentage = round($site['sqm'] / $max * 100); @endphp

                <div
                    data-reveal
                    data-infra-row
                    style="--reveal-delay: {{ $index * 80 }}ms"
                    class="flex flex-col gap-2 sm:flex-row sm:items-center sm:gap-6"
                >
                    <h3 class="font-display text-base font-semibold text-carbon sm:w-40 sm:shrink-0">
                        {{ $site['city'] }}
                    </h3>

                    <div class="h-3 flex-1 overflow-hidden rounded-full bg-gray-100">
                        <div
                            data-infra-bar
                            data-target-width="{{ $percentage }}"
                            data-target-value="{{ $site['sqm'] }}"
                            class="infra-bar h-full rounded-full"
                            style="--infra-width: {{ $percentage }}%; background: var(--color-{{ $accent }})"
                        ></div>
                    </div>

                    <div data-infra-value class="text-sm text-gray-500 sm:w-28 sm:text-right">
                        0 m&sup2;
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
