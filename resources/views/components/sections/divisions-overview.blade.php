@php
    $divisions = config('divisions');
    $firstSlug = array_key_first($divisions);
@endphp

<section id="divisiones" class="py-24 sm:py-32">
    <div class="container-grid flex flex-col gap-14">
        <x-ui.section-heading
            align="center"
            eyebrow="Grupo"
            title="Tres capacidades. Una misma visión."
            subtitle="Integramos capacidades industriales, logísticas e inmobiliarias para ofrecer soluciones que acompañan a nuestros clientes en cada etapa de su crecimiento."
            class="mx-auto"
        />

        <div data-division-switcher data-reveal class="flex flex-col gap-8 lg:flex-row lg:gap-16">
            {{-- Tabs --}}
            <div
                role="tablist"
                aria-label="Divisiones del grupo"
                class="flex gap-2 overflow-x-auto pb-1 lg:w-64 lg:shrink-0 lg:flex-col lg:gap-2 lg:overflow-visible lg:pb-0"
            >
                @foreach ($divisions as $slug => $division)
                    <button
                        type="button"
                        role="tab"
                        id="{{ $slug }}-tab"
                        aria-controls="{{ $slug }}-panel"
                        data-tab
                        data-division="{{ $slug }}"
                        aria-selected="{{ $slug === $firstSlug ? 'true' : 'false' }}"
                        tabindex="{{ $slug === $firstSlug ? '0' : '-1' }}"
                        style="--tab-accent: var(--color-{{ $division['accent'] }}); --tab-accent-soft: var(--color-{{ $division['accent_soft'] }});"
                        class="division-tab {{ $slug === $firstSlug ? 'is-active' : '' }} shrink-0 rounded-xl border border-gray-200 px-5 py-4 text-left transition-colors focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[var(--tab-accent)] lg:shrink"
                    >
                        <span class="division-tab__index block text-xs font-semibold uppercase tracking-[0.15em] text-gray-400">
                            0{{ $loop->iteration }}
                        </span>
                        <span class="division-tab__label block font-display text-lg font-semibold text-carbon">
                            {{ $division['name'] }}
                        </span>
                    </button>
                @endforeach
            </div>

            {{-- Panels: apilados con CSS grid (misma celda), transición por opacidad --}}
            <div class="grid flex-1">
                @foreach ($divisions as $slug => $division)
                    <div
                        role="tabpanel"
                        id="{{ $slug }}-panel"
                        aria-labelledby="{{ $slug }}-tab"
                        tabindex="0"
                        data-panel
                        data-division="{{ $slug }}"
                        style="--tab-accent: var(--color-{{ $division['accent'] }}); --tab-accent-soft: var(--color-{{ $division['accent_soft'] }});"
                        class="division-panel {{ $slug === $firstSlug ? 'is-active' : '' }} col-start-1 row-start-1"
                    >
                        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 sm:items-center">
                            <div class="division-panel__visual flex aspect-[4/3] flex-col items-center justify-center gap-4 rounded-3xl border border-gray-100 p-8 text-center">
                                <x-ui.icon :name="$division['icon']" class="h-10 w-10" />
                                <p class="text-xs text-gray-500">
                                    Placeholder de imagen — {{ implode(' · ', $division['visual_keywords']) }}
                                </p>
                            </div>

                            <div class="flex flex-col gap-5">
                                <span class="text-xs font-semibold uppercase tracking-[0.2em]" style="color: var(--tab-accent)">
                                    {{ $division['name'] }}
                                </span>
                                <p class="max-w-md text-base leading-relaxed text-gray-600 sm:text-lg">
                                    {{ $division['tagline'] }}
                                </p>
                                <div>
                                    <x-ui.button :href="route('divisions.show', $slug)" :accent="$division['accent']" variant="ghost">
                                        {{ $division['cta_label'] }} →
                                    </x-ui.button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
