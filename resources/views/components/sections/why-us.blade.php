@php
    $reasons = [
        ['title' => 'Experiencia', 'text' => 'Conocimiento especializado en diferentes industrias.', 'icon' => 'shield'],
        ['title' => 'Infraestructura', 'text' => 'Capacidad para operar y desarrollar proyectos de diferentes escalas.', 'icon' => 'building'],
        ['title' => 'Integración', 'text' => 'Industria + logística + infraestructura.', 'icon' => 'link'],
        ['title' => 'Tecnología', 'text' => 'Uso de tecnología para mejorar procesos y operaciones.', 'icon' => 'chip'],
        ['title' => 'Cobertura', 'text' => 'Presencia estratégica en puntos clave de México.', 'icon' => 'pin'],
        ['title' => 'Soluciones a la medida', 'text' => 'Cada proyecto se adapta a las necesidades del cliente.', 'icon' => 'sliders'],
    ];
@endphp

<section id="nosotros" class="py-24 sm:py-32">
    <div class="container-grid flex flex-col gap-14">
        <x-ui.section-heading
            align="center"
            eyebrow="Por qué nosotros"
            title="Por qué trabajar con nosotros"
            subtitle="Seis razones por las que empresas confían proyectos importantes al grupo."
            class="mx-auto"
        />

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($reasons as $reason)
                <div
                    data-reveal
                    style="--reveal-delay: {{ ($loop->index % 3) * 80 }}ms"
                    class="flex flex-col gap-4 rounded-2xl border border-gray-200 p-7 transition-colors hover:border-gray-300 hover:shadow-[0_16px_40px_-24px_rgba(23,24,28,0.2)]"
                >
                    <x-ui.icon :name="$reason['icon']" class="h-8 w-8 text-logistica" />
                    <h3 class="font-display text-lg font-semibold text-carbon">{{ $reason['title'] }}</h3>
                    <p class="text-sm leading-relaxed text-gray-600">{{ $reason['text'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
