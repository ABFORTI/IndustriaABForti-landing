@php
    $divisions = config('divisions');
    $logisticsCompanies = config('logistics.companies');
    $workCenters = config('logistics.work_centers');
    $extraCenters = config('logistics.extra_work_centers', []);
    $footprintByCompany = collect($workCenters)
        ->reduce(function ($carry, $center) {
            $carry[$center['company']] = ($carry[$center['company']] ?? 0) + ($center['size_m2'] ?? 0);
            return $carry;
        }, ['upperlogistics' => 0, 'controlup' => 0]);

    foreach ($extraCenters as $companySlug => $extras) {
        foreach ($extras as $extra) {
            $footprintByCompany[$companySlug] = ($footprintByCompany[$companySlug] ?? 0) + ($extra['size_m2'] ?? 0);
        }
    }

    $innovetLines = count($divisions['industria']['capabilities'] ?? []);
    $innovetSectors = count($divisions['industria']['industries_served'] ?? []);
    $inmobiliariaSteps = count($divisions['inmobiliaria']['process'] ?? []);
    $inmobiliariaTypes = count($divisions['inmobiliaria']['project_placeholders'] ?? []);

    $contactHrefFor = fn (string $company) => route('contact.show', ['empresa' => $company]);

    $areas = [
        [
            'slug' => 'industria',
            'label' => 'Innovet',
            'sector' => 'Industria · Procesos',
            'accent' => 'industria',
            'accent_soft' => 'industria-soft',
        ],
        [
            'slug' => 'logistica',
            'label' => 'Logística',
            'sector' => 'Upper Logistics + Control Up',
            'accent' => 'logistica',
            'accent_soft' => 'logistica-soft',
        ],
        [
            'slug' => 'inmobiliaria',
            'label' => 'Inmobiliaria',
            'sector' => 'Inmobiliaria · Infraestructura',
            'accent' => 'inmobiliaria',
            'accent_soft' => 'inmobiliaria-soft',
        ],
    ];

    $firstSlug = $areas[0]['slug'];
@endphp

<section id="divisiones" class="relative overflow-hidden py-16 sm:py-24">
    <div
        aria-hidden="true"
        class="pointer-events-none absolute inset-0 -z-10 opacity-60 [mask-image:radial-gradient(ellipse_at_top,black,transparent_75%)]"
        style="background-image: linear-gradient(to right, var(--color-gray-100) 1px, transparent 1px), linear-gradient(to bottom, var(--color-gray-100) 1px, transparent 1px); background-size: 44px 44px;"
    ></div>

    <div class="container-grid flex flex-col gap-10 sm:gap-14">
        <x-ui.section-heading
            align="center"
            eyebrow="Arquitectura del grupo"
            title="Tres áreas. Cuatro empresas especializadas."
            subtitle="Industria, logística e infraestructura operan bajo un mismo holding. La logística reúne a dos empresas — Upper Logistics y Control Up Logistics — sobre la misma red nacional."
            class="mx-auto"
        />

        <div class="flex flex-col items-center gap-0">
            <span class="hidden h-10 w-px bg-gradient-to-b from-gray-300 to-transparent lg:block" aria-hidden="true"></span>
        </div>

        <div data-division-switcher data-reveal class="flex flex-col gap-6 lg:flex-row lg:gap-16">
            <div
                role="tablist"
                aria-label="Áreas de negocio del grupo"
                class="grid grid-cols-3 gap-3 lg:w-72 lg:shrink-0 lg:grid-cols-1 lg:gap-2"
            >
                @foreach ($areas as $area)
                    <button
                        type="button"
                        role="tab"
                        id="{{ $area['slug'] }}-tab"
                        aria-controls="{{ $area['slug'] }}-panel"
                        data-tab
                        data-division="{{ $area['slug'] }}"
                        aria-selected="{{ $area['slug'] === $firstSlug ? 'true' : 'false' }}"
                        tabindex="{{ $area['slug'] === $firstSlug ? '0' : '-1' }}"
                        style="--tab-accent: var(--color-{{ $area['accent'] }}); --tab-accent-soft: var(--color-{{ $area['accent_soft'] }});"
                        class="division-tab {{ $area['slug'] === $firstSlug ? 'is-active' : '' }} flex min-h-[64px] flex-col justify-center gap-1 rounded-xl border border-gray-200 bg-white px-3 py-3 text-left transition-colors focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[var(--tab-accent)] sm:px-4 lg:px-5 lg:py-4"
                    >
                        <span class="division-tab__label flex items-center gap-2 font-display text-xs font-bold leading-tight text-carbon sm:text-sm lg:text-base">
                            <span class="h-1.5 w-1.5 shrink-0 rounded-full" style="background: var(--tab-accent)" aria-hidden="true"></span>
                            {{ $area['label'] }}
                        </span>
                        <span class="division-tab__index hidden text-[0.65rem] font-semibold uppercase tracking-[0.15em] text-gray-400 sm:block">
                            {{ $area['sector'] }}
                        </span>
                    </button>
                @endforeach
            </div>

            <div class="grid flex-1">
                @php $innovet = $divisions['industria']; @endphp
                <div
                    role="tabpanel"
                    id="industria-panel"
                    aria-labelledby="industria-tab"
                    tabindex="0"
                    data-panel
                    data-division="industria"
                    style="--tab-accent: var(--color-industria); --tab-accent-soft: var(--color-industria-soft);"
                    class="division-panel {{ 'industria' === $firstSlug ? 'is-active' : '' }} col-start-1 row-start-1"
                >
                    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 sm:items-center">
                        <div class="relative aspect-[4/3] overflow-hidden rounded-3xl border border-gray-100">
                            <img
                                src="{{ asset($innovet['image']) }}"
                                alt="Innovet"
                                loading="lazy"
                                decoding="async"
                                class="h-full w-full object-cover"
                            />
                            <span class="absolute left-4 top-4 inline-flex items-center rounded-full bg-white/95 px-3 py-1.5 shadow-sm">
                                <img src="{{ asset($innovet['logo']) }}" alt="" class="h-5 w-auto object-contain" />
                            </span>
                            <span class="absolute right-4 top-4 inline-flex items-center rounded-full border border-white/20 bg-black/40 px-3 py-1.5 text-[0.65rem] font-semibold uppercase tracking-[0.12em] text-white backdrop-blur-md">
                                Industria · Procesos
                            </span>
                        </div>

                        <div class="flex flex-col gap-5">
                            <span class="text-xs font-semibold uppercase tracking-[0.2em]" style="color: var(--tab-accent)">
                                Innovet
                            </span>

                            <p class="max-w-md text-base leading-relaxed text-gray-600 sm:text-lg">
                                {{ $innovet['tagline'] }}
                            </p>

                            <dl class="grid grid-cols-2 gap-3">
                                <div class="flex flex-col gap-1 rounded-xl border border-gray-100 bg-gray-50/60 px-4 py-3">
                                    <dt class="flex items-center gap-1.5 text-[0.65rem] font-semibold uppercase tracking-[0.12em] text-gray-400">
                                        <x-ui.icon name="boxes" style="color: var(--tab-accent)" class="h-3.5 w-3.5 shrink-0" />
                                        Charolas, blisters y clamshells
                                    </dt>
                                    <dd class="font-display text-lg font-bold text-carbon">{{ $innovetLines }} líneas</dd>
                                </div>
                                <div class="flex flex-col gap-1 rounded-xl border border-gray-100 bg-gray-50/60 px-4 py-3">
                                    <dt class="flex items-center gap-1.5 text-[0.65rem] font-semibold uppercase tracking-[0.12em] text-gray-400">
                                        <x-ui.icon name="shield" style="color: var(--tab-accent)" class="h-3.5 w-3.5 shrink-0" />
                                        Atendidos con diseño exclusivo
                                    </dt>
                                    <dd class="font-display text-lg font-bold text-carbon">{{ $innovetSectors }} sectores</dd>
                                </div>
                            </dl>

                            <div class="flex flex-col gap-3 pt-1 sm:flex-row sm:flex-wrap sm:items-center">
                                <x-ui.button :href="$contactHrefFor('innovet')" accent="industria">
                                    Cotizar piezas termoformadas
                                </x-ui.button>
                                <x-ui.button :href="route('divisions.show', 'industria')" accent="industria" variant="ghost">
                                    Explorar capacidad industrial →
                                </x-ui.button>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    role="tabpanel"
                    id="logistica-panel"
                    aria-labelledby="logistica-tab"
                    tabindex="0"
                    data-panel
                    data-division="logistica"
                    style="--tab-accent: var(--color-logistica); --tab-accent-soft: var(--color-logistica-soft);"
                    class="division-panel {{ 'logistica' === $firstSlug ? 'is-active' : '' }} col-start-1 row-start-1"
                >
                    <div class="flex flex-col gap-6">
                        <div class="flex flex-col gap-2">
                            <span class="text-xs font-semibold uppercase tracking-[0.2em]" style="color: var(--tab-accent)">
                                Logística
                            </span>
                            <h3 class="font-display text-xl font-bold text-carbon sm:text-2xl">
                                Dos empresas, una misma red
                            </h3>
                            <p class="max-w-2xl text-sm leading-relaxed text-gray-600 sm:text-base">
                                Upper Logistics y Control Up Logistics operan bajo el mismo ecosistema logístico, con
                                centros de trabajo y conexiones compartidas en todo el país.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                            @foreach ($logisticsCompanies as $companySlug => $company)
                                <article
                                    data-reveal
                                    style="--reveal-delay: {{ $loop->index * 100 }}ms; --company-accent: var(--color-{{ $company['accent'] }}); --company-accent-soft: var(--color-{{ $company['accent_soft'] }})"
                                    class="company-card relative flex flex-col gap-4 overflow-hidden rounded-3xl border border-gray-200 p-6 sm:p-7"
                                >
                                    <span
                                        class="absolute inset-x-0 top-0 h-1.5"
                                        style="background: linear-gradient(90deg, var(--company-accent), var(--company-accent-soft))"
                                        aria-hidden="true"
                                    ></span>

                                    <div class="flex items-center gap-4">
                                        <span class="flex h-14 w-24 shrink-0 items-center justify-center rounded-2xl border border-gray-100 bg-white p-2 shadow-sm">
                                            <img
                                                src="{{ asset($company['logo']) }}"
                                                alt="Logo {{ $company['name'] }}"
                                                class="h-full w-full object-contain"
                                                loading="lazy"
                                                decoding="async"
                                            />
                                        </span>
                                        <div class="flex min-w-0 flex-col gap-1">
                                            <span class="text-xs font-semibold uppercase tracking-[0.2em]" style="color: var(--company-accent)">
                                                {{ $company['tag'] }}
                                            </span>
                                            <h4 class="font-display text-lg font-bold leading-tight text-carbon">{{ $company['name'] }}</h4>
                                        </div>
                                    </div>

                                    <p class="text-sm leading-relaxed text-gray-600">
                                        {{ $company['description'] }}
                                    </p>

                                    @if (!empty($footprintByCompany[$companySlug]))
                                        <div class="flex w-fit items-center gap-1.5 rounded-full px-3 py-1 text-xs font-semibold" style="background: color-mix(in srgb, var(--company-accent) 12%, white); color: var(--company-accent)">
                                            <x-ui.icon name="building" class="h-3.5 w-3.5" />
                                            {{ number_format($footprintByCompany[$companySlug], 0, '.', ',') }} m² en operación
                                        </div>
                                    @else
                                        <div class="flex w-fit items-center gap-1.5 rounded-full px-3 py-1 text-xs font-semibold" style="background: color-mix(in srgb, var(--company-accent) 12%, white); color: var(--company-accent)">
                                            <x-ui.icon name="layers" class="h-3.5 w-3.5" />
                                            {{ count($company['traits']) }} servicios especializados
                                        </div>
                                    @endif

                                    <div class="flex flex-wrap gap-2">
                                        @foreach (array_slice($company['traits'], 0, 3) as $trait)
                                            <span
                                                class="rounded-full border px-3 py-1.5 text-xs font-medium text-carbon"
                                                style="border-color: color-mix(in srgb, var(--company-accent) 40%, white)"
                                            >
                                                {{ $trait }}
                                            </span>
                                        @endforeach
                                    </div>

                                    <x-ui.button :href="$contactHrefFor($companySlug)" :accent="$company['accent']" class="mt-auto w-fit">
                                        {{ $companySlug === 'controlup' ? 'Cotizar operación 3PL' : 'Cotizar flete o almacenaje' }}
                                    </x-ui.button>
                                </article>
                            @endforeach
                        </div>

                        <div>
                            <x-ui.button :href="route('divisions.show', 'logistica')" accent="logistica" variant="ghost">
                                Explorar red logística completa →
                            </x-ui.button>
                        </div>
                    </div>
                </div>

                {{-- Panel: Inmobiliaria --}}
                @php $inmobiliaria = $divisions['inmobiliaria']; @endphp
                <div
                    role="tabpanel"
                    id="inmobiliaria-panel"
                    aria-labelledby="inmobiliaria-tab"
                    tabindex="0"
                    data-panel
                    data-division="inmobiliaria"
                    style="--tab-accent: var(--color-inmobiliaria); --tab-accent-soft: var(--color-inmobiliaria-soft);"
                    class="division-panel {{ 'inmobiliaria' === $firstSlug ? 'is-active' : '' }} col-start-1 row-start-1"
                >
                    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 sm:items-center">
                        <div class="relative aspect-[4/3] overflow-hidden rounded-3xl border border-gray-100">
                            <img
                                src="{{ asset($inmobiliaria['image']) }}"
                                alt="Inmobiliaria"
                                loading="lazy"
                                decoding="async"
                                class="h-full w-full object-cover"
                            />
                            <span class="absolute left-4 top-4 inline-flex items-center rounded-full bg-white/95 px-3 py-1.5 shadow-sm">
                                <img src="{{ asset('logo/forti-logo.png') }}" alt="" class="h-5 w-auto object-contain" />
                            </span>
                            <span class="absolute right-4 top-4 inline-flex items-center rounded-full border border-white/20 bg-black/40 px-3 py-1.5 text-[0.65rem] font-semibold uppercase tracking-[0.12em] text-white backdrop-blur-md">
                                Inmobiliaria · Infraestructura
                            </span>
                        </div>

                        <div class="flex flex-col gap-5">
                            <span class="text-xs font-semibold uppercase tracking-[0.2em]" style="color: var(--tab-accent)">
                                Inmobiliaria
                            </span>

                            <p class="max-w-md text-base leading-relaxed text-gray-600 sm:text-lg">
                                {{ $inmobiliaria['tagline'] }}
                            </p>

                            <dl class="grid grid-cols-2 gap-3">
                                <div class="flex flex-col gap-1 rounded-xl border border-gray-100 bg-gray-50/60 px-4 py-3">
                                    <dt class="flex items-center gap-1.5 text-[0.65rem] font-semibold uppercase tracking-[0.12em] text-gray-400">
                                        <x-ui.icon name="sliders" style="color: var(--tab-accent)" class="h-3.5 w-3.5 shrink-0" />
                                        Proceso llave en mano
                                    </dt>
                                    <dd class="font-display text-lg font-bold text-carbon">{{ $inmobiliariaSteps }} etapas</dd>
                                </div>
                                <div class="flex flex-col gap-1 rounded-xl border border-gray-100 bg-gray-50/60 px-4 py-3">
                                    <dt class="flex items-center gap-1.5 text-[0.65rem] font-semibold uppercase tracking-[0.12em] text-gray-400">
                                        <x-ui.icon name="building" style="color: var(--tab-accent)" class="h-3.5 w-3.5 shrink-0" />
                                        De desarrollo industrial
                                    </dt>
                                    <dd class="font-display text-lg font-bold text-carbon">{{ $inmobiliariaTypes }} tipos</dd>
                                </div>
                            </dl>

                            <div class="flex flex-col gap-3 pt-1 sm:flex-row sm:flex-wrap sm:items-center">
                                <x-ui.button :href="$contactHrefFor('inmobiliaria')" accent="inmobiliaria">
                                    Cotizar desarrollo inmobiliario
                                </x-ui.button>
                                <x-ui.button :href="route('divisions.show', 'inmobiliaria')" accent="inmobiliaria" variant="ghost">
                                    Explorar capacidad inmobiliaria →
                                </x-ui.button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CTA Matrix: enterprise vs. específico --}}
        <div class="flex flex-col items-center justify-between gap-5 rounded-2xl border border-gray-200 bg-gray-50/60 p-6 sm:flex-row sm:p-8">
            <div class="flex flex-col gap-1 text-center sm:text-left">
                <p class="font-display text-lg font-semibold text-carbon">¿Tu proyecto cruza varias áreas?</p>
                <p class="text-sm leading-relaxed text-gray-600">Coordinamos industria, logística e infraestructura bajo una sola cotización de grupo.</p>
            </div>
            <x-ui.button :href="$contactHrefFor('ab-forti')" class="shrink-0">
                Cotizar proyecto integral de grupo →
            </x-ui.button>
        </div>
    </div>
</section>
