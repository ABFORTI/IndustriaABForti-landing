@props(['companies', 'workCenters', 'locations'])

@php

    $extraCenters = config('logistics.extra_work_centers', []);

    $centersByCompany = collect($workCenters)->reduce(function ($carry, $center, $slug) use ($locations) {
        $location = $locations[$slug] ?? null;
        if ($location) {
            $carry[$center['company']][] = [
                'slug' => $slug,
                'city' => $location['city'],
                'size_m2' => $center['size_m2'] ?? null,
                'port' => $center['port'] ?? false,
                'interactive' => true,
            ];
        }
        return $carry;
    }, ['upperlogistics' => [], 'controlup' => []]);

    foreach ($extraCenters as $companySlug => $extras) {
        foreach ($extras as $extra) {
            $centersByCompany[$companySlug][] = [
                'slug' => null,
                'city' => $extra['city'],
                'size_m2' => $extra['size_m2'] ?? null,
                'port' => false,
                'interactive' => false,
            ];
        }
    }

    $footprintByCompany = collect($centersByCompany)->map(
        fn ($centers) => collect($centers)->sum('size_m2')
    );
@endphp

<section class="py-16 sm:py-16">
    <div class="container-grid flex flex-col gap-12">
        <x-ui.section-heading
            title="Dos empresas, una misma red"
            subtitle="UpperLogistics y Control Up Logistics operan bajo un mismo ecosistema logístico."
        />

        <div data-company-nodes class="grid grid-cols-1 gap-5 md:grid-cols-2">
            @foreach ($companies as $slug => $company)
                <article
                    data-company-card
                    tabindex="0"
                    role="button"
                    aria-expanded="false"
                    data-reveal
                    style="--reveal-delay: {{ $loop->index * 100 }}ms; --company-accent: var(--color-{{ $company['accent'] }}); --company-accent-soft: var(--color-{{ $company['accent_soft'] ?? $company['accent'] }})"
                    class="company-card group relative flex flex-col gap-5 overflow-hidden rounded-3xl border border-gray-200 p-6 transition-all duration-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[var(--company-accent)] sm:p-8"
                >
                    <span
                        class="absolute inset-x-0 top-0 h-1.5"
                        style="background: linear-gradient(90deg, var(--company-accent), var(--company-accent-soft))"
                        aria-hidden="true"
                    ></span>

                    <div class="flex items-start justify-between gap-4">
                        <div class="flex flex-1 items-center gap-4">
                            @if (!empty($company['logo']))
                                <span class="flex h-14 w-24 shrink-0 items-center justify-center rounded-2xl border border-gray-100 bg-white p-2 shadow-sm transition-transform duration-300 group-hover:scale-105 sm:w-28">
                                    <img
                                        src="{{ asset($company['logo']) }}"
                                        alt="Logo de {{ $company['name'] }}"
                                        class="h-full w-full object-contain"
                                        loading="lazy"
                                        decoding="async"
                                    />
                                </span>
                            @elseif (!empty($company['icon']))
                                <span
                                    class="company-card__badge flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl transition-transform duration-300 group-hover:scale-105"
                                    style="background: linear-gradient(135deg, color-mix(in srgb, var(--company-accent) 85%, black), var(--company-accent-soft)); color: #ffffff"
                                >
                                    <x-ui.icon :name="$company['icon']" class="h-6 w-6" />
                                </span>
                            @endif
                            <div class="flex min-w-0 flex-col gap-1">
                                <span class="text-xs font-semibold uppercase tracking-[0.2em]" style="color: var(--company-accent)">
                                    {{ $company['tag'] }}
                                </span>
                                <h3 class="font-display text-xl font-bold leading-tight text-carbon sm:text-2xl">{{ $company['name'] }}</h3>
                            </div>
                        </div>
                        <span class="company-card__chevron flex h-9 w-9 shrink-0 items-center justify-center rounded-full border border-gray-200 text-carbon transition-transform duration-300">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M6 9l6 6 6-6" />
                            </svg>
                        </span>
                    </div>

                    <p class="max-w-md text-sm leading-relaxed text-gray-600 sm:text-base">
                        {{ $company['description'] }}
                    </p>

                    @if (! empty($footprintByCompany[$slug]))
                        <div class="-mt-1 flex w-fit items-center gap-1.5 rounded-full px-3 py-1 text-xs font-semibold" style="background: color-mix(in srgb, var(--company-accent) 12%, white); color: var(--company-accent)">
                            <x-ui.icon name="building" class="h-3.5 w-3.5" />
                            {{ number_format($footprintByCompany[$slug], 0, '.', ',') }} m² en operación
                        </div>
                    @endif

                    <div class="company-card__details grid grid-rows-[0fr] transition-[grid-template-rows] duration-300 ease-out">
                        <div class="flex flex-col gap-5 overflow-hidden">
                            <div class="flex flex-wrap gap-2 pt-2">
                                @foreach ($company['traits'] as $trait)
                                    <span
                                        class="rounded-full border px-3 py-1.5 text-xs font-medium text-carbon"
                                        style="border-color: color-mix(in srgb, var(--company-accent) 40%, white)"
                                    >
                                        {{ $trait }}
                                    </span>
                                @endforeach
                            </div>

                            @if (! empty($centersByCompany[$slug]))
                                <div class="flex flex-col gap-2">
                                    <span class="text-xs font-semibold uppercase tracking-[0.15em] text-gray-400">Centros de trabajo</span>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($centersByCompany[$slug] as $center)
                                            @if ($center['interactive'])
                                                <span
                                                    class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs font-semibold text-white {{ $center['port'] ? 'ring-2 ring-offset-1' : '' }}"
                                                    style="background: var(--company-accent); {{ $center['port'] ? '--tw-ring-color: var(--company-accent-soft)' : '' }}"
                                                >
                                                    @if ($center['port'])
                                                        <x-ui.icon name="anchor" class="h-3 w-3" />
                                                    @endif
                                                    {{ $center['city'] }}
                                                    @if ($center['size_m2'])
                                                        <span class="opacity-85">· {{ number_format($center['size_m2'], 0, '.', ',') }} m²</span>
                                                    @endif
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center gap-1.5 rounded-full border px-3 py-1.5 text-xs font-semibold"
                                                    style="border-color: color-mix(in srgb, var(--company-accent) 45%, white); color: var(--company-accent)"
                                                >
                                                    {{ $center['city'] }}
                                                    @if ($center['size_m2'])
                                                        <span class="opacity-85">· {{ number_format($center['size_m2'], 0, '.', ',') }} m²</span>
                                                    @endif
                                                </span>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if ($company['reference'])
                                <a
                                    href="{{ $company['reference'] }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex w-fit items-center gap-1 text-sm font-semibold"
                                    style="color: var(--company-accent)"
                                >
                                    Sitio de {{ $company['name'] }} →
                                </a>
                            @endif
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
