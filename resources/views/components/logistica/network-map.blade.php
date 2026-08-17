@props(['division'])

<section id="red-logistica" class="scroll-mt-24 bg-gray-50/60 py-16 sm:py-20">
    <div class="container-grid flex flex-col gap-8">
        <x-ui.section-heading
            eyebrow="Red logística"
            title="Así se mueve la carga dentro de la red"
            subtitle="Explora el mapa para ver nuestros centros de trabajo y cómo llegan las cargas desde distintos orígenes."
        />

        <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-[0_20px_60px_-30px_rgba(23,24,28,0.25)]">
            <iframe
                src="{{ asset('mapa_logistico_marketing/index.html') }}"
                title="Mapa logístico de presencia física"
                class="block h-[520px] w-full border-0 sm:h-[600px]"
                loading="lazy"
            ></iframe>
        </div>
    </div>
</section>
