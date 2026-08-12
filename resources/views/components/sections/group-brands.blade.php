@php
    $brands = [
        [
            'name' => 'Innovet',
            'tag' => 'Industria',
            'logo' => 'logo/innovet-logo.png',
            'href' => route('divisions.show', 'industria'),
        ],
        [
            'name' => 'Upper Logistics',
            'tag' => 'Logística',
            'logo' => 'logo/upper-logo.png',
            'href' => route('divisions.show', 'logistica'),
        ],
        [
            'name' => 'Control Up Logistics',
            'tag' => 'Logística',
            'logo' => 'logo/controlUp-logo.png',
            'href' => route('divisions.show', 'logistica'),
        ],
    ];
@endphp

<section class="py-16 sm:py-20">
    <div class="container-grid flex flex-col gap-10">
        <x-ui.section-heading
            align="center"
            eyebrow="Nuestras marcas"
            title="Un grupo, tres marcas especializadas"
            subtitle="Cada empresa opera con su propia identidad, integradas bajo una misma visión de grupo."
            class="mx-auto"
        />

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-3 sm:gap-6">
            @foreach ($brands as $brand)
                <a
                    href="{{ $brand['href'] }}"
                    data-reveal
                    style="--reveal-delay: {{ $loop->index * 80 }}ms"
                    class="group flex flex-col items-center gap-5 rounded-3xl border border-gray-200 bg-white p-6 text-center transition-all duration-300 hover:-translate-y-1 hover:border-gray-300 hover:shadow-[0_20px_60px_-30px_rgba(23,24,28,0.25)] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-carbon sm:p-8"
                >
                    <span class="flex h-12 w-full items-center justify-center">
                        <img
                            src="{{ asset($brand['logo']) }}"
                            alt="Logo {{ $brand['name'] }}"
                            class="max-h-12 w-auto object-contain transition duration-300 sm:max-h-16"
                        />
                    </span>
                </a>
            @endforeach
        </div>
    </div>
</section>
