@php
    $columns = [
        'Grupo' => [
            ['label' => 'Nosotros', 'href' => route('home').'#nosotros'],
            ['label' => 'Nuestra visión', 'href' => route('home')],
            ['label' => 'Contacto', 'href' => route('home').'#contacto'],
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
        'Inmobiliaria' => [
            ['label' => 'Proyectos', 'href' => route('divisions.show', 'inmobiliaria')],
            ['label' => 'Llave en mano', 'href' => route('divisions.show', 'inmobiliaria')],
            ['label' => 'Contacto', 'href' => route('divisions.show', 'inmobiliaria')],
        ],
    ];

@endphp

<footer class="bg-carbon text-white">
    <div class="container-grid flex flex-col gap-16 py-20">

        <div class="grid grid-cols-1 gap-12 sm:grid-cols-2 lg:grid-cols-[1.4fr_1fr_1fr_1fr_1fr]">
            <div class="flex flex-col gap-4">
                <a
                    href="{{ route('home') }}"
                    class="rounded-sm font-display text-xl font-bold tracking-tight text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-white"
                >
                    Business AB Forti<span class="text-white/40">.</span>
                </a>

                <p class="max-w-xs text-sm leading-relaxed text-white/60">
                    Industria, logística e infraestructura bajo una misma visión.
                </p>

                <dl class="mt-2 flex flex-col gap-2 text-sm text-white/70">
                    <div class="flex gap-2">
                        <dt class="text-white/40">Tel:</dt>
                        <dd>[Teléfono]</dd>
                    </div>
                    <div class="flex gap-2">
                        <dt class="text-white/40">Comercial:</dt>
                        <dd>[Correo innovet]</dd>
                    </div>
                    <div class="flex gap-2">
                        <dt class="text-white/40">Comercial:</dt>
                        <dd>[Correo upper]</dd>
                    </div>
                    <div class="flex gap-2">
                        <dt class="text-white/40">Dirección:</dt>
                        <dd>[Dirección]</dd>
                    </div>
                </dl>
            </div>

            @foreach ($columns as $title => $links)
                <div class="flex flex-col gap-4">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-white/40">{{ $title }}</p>
                    <ul class="flex flex-col gap-3">
                        @foreach ($links as $link)
                            <li>
                                <a
                                    href="{{ $link['href'] }}"
                                    class="rounded-sm text-sm text-white/70 transition-colors hover:text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-white"
                                >
                                    {{ $link['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        <div class="flex flex-col gap-2 border-t border-white/10 pt-8 text-xs text-white/40 sm:flex-row sm:items-center sm:justify-between">
            <p>&copy; {{ date('Y') }} [AB Forti Corporativo]. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>
