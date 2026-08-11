@props(['companies', 'workCenters', 'locations'])

@php

    $centersByCompany = collect($workCenters)->reduce(function ($carry, $center, $slug) use ($locations) {
        $location = $locations[$slug] ?? null;
        if ($location) {
            $carry[$center['company']][] = ['slug' => $slug, 'city' => $location['city']];
        }
        return $carry;
    }, ['upperlogistics' => [], 'controlup' => []]);
@endphp

<section class="py-16 sm:py-20">
    <div class="container-grid flex flex-col gap-10">
        <x-ui.section-heading
            eyebrow="Empresas"
            title="Dos empresas, una misma red"
            subtitle="UpperLogistics y Control Up Logistics operan bajo un mismo ecosistema logístico. Pasa el cursor o toca cada una para ver qué la distingue."
        />

        <div data-company-nodes class="grid grid-cols-1 gap-5 md:grid-cols-2">
            @foreach ($companies as $slug => $company)
                <article
                    data-company-card
                    tabindex="0"
                    role="button"
                    aria-expanded="false"
                    data-reveal
                    style="--reveal-delay: {{ $loop->index * 100 }}ms; --company-accent: var(--color-{{ $company['accent'] }})"
                    class="company-card group relative flex flex-col gap-5 overflow-hidden rounded-3xl border border-gray-200 p-6 transition-all duration-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[var(--company-accent)] sm:p-8"
                >
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex flex-col gap-1">
                            <span class="text-xs font-semibold uppercase tracking-[0.2em]" style="color: var(--company-accent)">
                                {{ $company['tag'] }}
                            </span>
                            <h3 class="font-display text-2xl font-bold text-carbon">{{ $company['name'] }}</h3>
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
                                            <button
                                                type="button"
                                                data-goto-center="{{ $center['slug'] }}"
                                                class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs font-semibold text-white transition-transform hover:scale-105 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2"
                                                style="background: var(--company-accent)"
                                            >
                                                {{ $center['city'] }}
                                                <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                    <path d="M9 6l6 6-6 6" />
                                                </svg>
                                            </button>
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
