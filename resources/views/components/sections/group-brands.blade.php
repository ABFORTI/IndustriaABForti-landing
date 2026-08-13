@php
    $divisions = config('divisions');

    $brands = [
        [
            'name' => 'Innovet',
            'tag' => 'Industria',
            'logo' => 'logo/innovet-logo.png',
            'value' => $divisions['industria']['tagline'],
            'accent' => 'industria',
            'href' => route('divisions.show', 'industria'),
            'cta' => 'Conocer Industria',
        ],
        [
            'name' => 'Upper Logistics',
            'tag' => 'Logística',
            'logo' => 'logo/upper-logo.png',
            'value' => 'Almacenaje a la medida, transporte terrestre y una red de centros logísticos en todo el país.',
            'accent' => 'logistica',
            'href' => route('divisions.show', 'logistica'),
            'cta' => 'Conocer Logística',
        ],
        [
            'name' => 'Control Up Logistics',
            'tag' => 'Logística',
            'logo' => 'logo/controlUp-logo.png',
            'value' => '3PL, agencia aduanal y cross docking, con atención dedicada dentro de la misma red.',
            'accent' => 'controlup',
            'href' => route('divisions.show', 'logistica'),
            'cta' => 'Conocer Control Up',
        ],
        [
            'name' => 'AB Forti Inmobiliaria',
            'tag' => 'Inmobiliaria',
            'logo' => 'logo/forti-logo.png',
            'value' => $divisions['inmobiliaria']['tagline'],
            'accent' => 'inmobiliaria',
            'href' => route('divisions.show', 'inmobiliaria'),
            'cta' => 'Conocer Inmobiliaria',
        ],
    ];
@endphp

<section class="py-16 sm:py-20">
    <div class="container-grid flex flex-col gap-10">
        <x-ui.section-heading
            align="center"
            eyebrow="Nuestras marcas"
            title="Cuatro empresas, un solo aliado estratégico."
            subtitle="Un ecosistema de empresas especializadas que trabajan de forma sincronizada para elevar la competitividad de tu empresa."
            class="mx-auto"
        />

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 sm:gap-6 lg:grid-cols-4">
            @foreach ($brands as $brand)
                <a
                    href="{{ $brand['href'] }}"
                    data-reveal
                    style="--reveal-delay: {{ $loop->index * 80 }}ms"
                    class="group flex flex-col gap-5 rounded-3xl border border-gray-200 bg-white p-6 text-left transition-all duration-300 hover:-translate-y-1 hover:border-gray-300 hover:shadow-[0_20px_60px_-30px_rgba(23,24,28,0.25)] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-carbon sm:p-7"
                >
                    <span class="flex h-12 items-center">
                        <img
                            src="{{ asset($brand['logo']) }}"
                            alt="Logo {{ $brand['name'] }}"
                            class="max-h-10 w-auto object-contain transition duration-300"
                        />
                    </span>

                    <div class="flex flex-1 flex-col gap-2">
                        <span class="text-xs font-semibold uppercase tracking-[0.2em]" style="color: var(--color-{{ $brand['accent'] }})">
                            {{ $brand['tag'] }}
                        </span>
                        <h3 class="font-display text-lg font-bold leading-snug text-carbon">
                            {{ $brand['name'] }}
                        </h3>
                        <p class="text-sm leading-relaxed text-gray-600">
                            {{ $brand['value'] }}
                        </p>
                    </div>

                    <span
                        class="mt-auto inline-flex items-center gap-1 text-sm font-semibold"
                        style="color: var(--color-{{ $brand['accent'] }})"
                    >
                        {{ $brand['cta'] }}
                        <svg class="h-3.5 w-3.5 transition-transform group-hover:translate-x-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M9 6l6 6-6 6" />
                        </svg>
                    </span>
                </a>
            @endforeach
        </div>
    </div>
</section>
