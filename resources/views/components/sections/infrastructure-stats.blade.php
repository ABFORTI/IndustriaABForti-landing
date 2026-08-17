@props(['sites', 'accent', 'instanceId' => 'infrastructure-map'])

@php
    $max = max(array_column($sites, 'sqm'));
@endphp

<section class="pt-16 pb-6 sm:pb-8">
    <div class="container-grid flex flex-col gap-10">
        <x-ui.section-heading
            eyebrow="Infraestructura"
            title="Presencia física del grupo"
            subtitle="Metros cuadrados de almacenaje y operación por sede."
        />

        <div class="hidden flex-col gap-5 sm:flex">
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
        <div class="-mx-4 rounded-2xl border border-gray-100 bg-gray-50/60 p-2 shadow-[0_20px_60px_-30px_rgba(23,24,28,0.25)] sm:mx-0 sm:rounded-3xl sm:p-6">
            <img src="{{ asset('img/home_fisica.jpeg') }}" alt="Imagen">
        </div>
    </div>
</section>
