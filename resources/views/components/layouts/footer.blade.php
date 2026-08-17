@php
    $columns = [
        'Grupo' => [
            ['label' => 'Nosotros', 'href' => route('home').'#nosotros'],
            ['label' => 'Nuestra visión', 'href' => route('home')],
            ['label' => 'Contacto', 'href' => route('contact.show')],
        ],
        'Industria' => [
            ['label' => 'Soluciones', 'href' => route('divisions.show', 'industria')],
            ['label' => 'Industrias', 'href' => route('divisions.show', 'industria')],
            ['label' => 'Proyectos', 'href' => route('divisions.show', 'industria')],
        ],
        'Logística' => [
            ['label' => 'Almacenaje', 'href' => route('divisions.show', 'logistica')],
            ['label' => 'Transporte', 'href' => route('divisions.show', 'logistica')],
            ['label' => 'Logística', 'href' => route('divisions.show', 'logistica')],
        ],
    ];

@endphp

<footer class="bg-carbon text-white">
    <div class="container-grid flex flex-col gap-16 py-20">

        <div class="grid grid-cols-1 gap-12 sm:grid-cols-2 lg:grid-cols-[1.4fr_1fr_1fr_1fr]">
            <div class="flex flex-col gap-2">
                <a
                    href="{{ route('home') }}"
                    class="rounded-sm font-display text-xl font-bold tracking-tight text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-white"
                >
                    Business AB Forti<span class="text-white/40">.</span>
                </a>

                <p class="max-w-xs text-sm leading-relaxed text-white/60">
                    Grupo empresarial mexicano. Industria, logística e infraestructura bajo una misma visión.
                </p>

                <dl class="mt-2 flex flex-col gap-2 text-sm text-white/70">
                    <div class="flex gap-2">
                        <dt class="text-white/40">Tel:</dt>
                        <dd>442 221 5943</dd>
                    </div>
                    <div class="flex gap-2">
                        <dt class="text-white/40">Dirección:</dt>
                        <dd>Plaza Omega Center, PA-228, Parque Industrial Bernardo Quintana, 76246 Qro.</dd>
                    </div>
                    <div class="flex gap-2">
                        <dt class="text-white/40">AB Forti:</dt>
                        <dd>soporte@ab-forti.com</dd>
                    </div>
                    <div class="flex gap-2">
                        <dt class="text-white/40">Innovet:</dt>
                        <dd>correo@innovet.com</dd>
                    </div>
                    <div class="flex gap-2">
                        <dt class="text-white/40">Upper Logistics:</dt>
                        <dd>correo@upperlogistics.com</dd>
                    </div>
                    <div class="flex gap-2">
                        <dt class="text-white/40">Control Up:</dt>
                        <dd>correo@upperlogistics.com</dd>
                    </div>
                </dl>
            </div>
        </div>
        
        <div class="grid grid-cols-2 gap-6 border-t border-white/10 pt-8 sm:grid-cols-4 lg:gap-8">

            <div class="flex aspect-square max-h-32 items-center justify-center overflow-hidden rounded-full bg-white p-6 shadow-sm transition duration-300 hover:scale-[1.03]">
                <img
                    class="h-full w-full object-contain"
                    src="{{ asset('logo/forti-logo.png') }}"
                    alt="Logo Forti"
                />
            </div>

            <div class="flex aspect-square max-h-32 items-center justify-center overflow-hidden rounded-full bg-white p-2 shadow-sm transition duration-300 hover:scale-[1.03]">
                <img
                    class="h-full w-full object-contain"
                    src="{{ asset('logo/upper-logo.png') }}"
                    alt="Logo UpperLogistics"
                />
            </div>

            <div class="flex aspect-square max-h-32 items-center justify-center overflow-hidden rounded-full bg-white p-2 shadow-sm transition duration-300 hover:scale-[1.03]">
                <img
                    class="h-full w-full object-contain"
                    src="{{ asset('logo/controlUp-logo.png') }}"
                    alt="Logo Control Up Logistics"
                />
            </div>

            <div class="flex aspect-square max-h-32 items-center justify-center overflow-hidden rounded-full bg-white p-4 shadow-sm transition duration-300 hover:scale-[1.03]">
                <img
                    class="h-full w-full object-contain"
                    src="{{ asset('logo/innovet-logo.png') }}"
                    alt="Logo Innovet"
                />
            </div>

        </div>

        <div class="flex flex-col gap-2 border-t border-white/10 pt-8 text-xs text-white/40 sm:flex-row sm:items-center sm:justify-between">
            <p>&copy; {{ date('Y') }} Business AB Forti. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>

