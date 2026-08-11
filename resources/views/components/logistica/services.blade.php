@props(['services'])

<section class="py-16 sm:py-20">
    <div class="container-grid flex flex-col gap-10">
        <x-ui.section-heading
            eyebrow="Servicios"
            title="Capacidades compartidas de la red"
            subtitle="Los mismos servicios, disponibles en ambas empresas. Toca cada uno para ver de qué se trata."
        />

        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-5">
            @foreach ($services as $index => $service)
                <button
                    type="button"
                    data-service-card
                    data-reveal
                    aria-expanded="false"
                    style="--reveal-delay: {{ $index * 60 }}ms"
                    class="service-card group flex flex-col items-center gap-3 rounded-2xl border border-gray-200 p-5 text-center transition-colors hover:border-logistica focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-logistica"
                >
                    <span class="flex h-12 w-12 items-center justify-center rounded-full bg-logistica/10 text-logistica transition-transform duration-300 group-hover:scale-110">
                        <x-ui.icon :name="$service['icon']" class="h-6 w-6" />
                    </span>
                    <span class="font-display text-sm font-semibold text-carbon">{{ $service['label'] }}</span>

                    <span class="service-card__description grid grid-rows-[0fr] text-xs leading-relaxed text-gray-500 transition-[grid-template-rows] duration-300">
                        <span class="overflow-hidden">{{ $service['description'] }}</span>
                    </span>
                </button>
            @endforeach
        </div>
    </div>
</section>
