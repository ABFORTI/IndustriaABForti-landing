<section class="bg-gray-50/60 py-24 sm:py-32">
    <div class="container-grid grid grid-cols-1 items-center gap-12 lg:grid-cols-[1.5fr_1fr] lg:gap-16">

        <div data-reveal class="rounded-3xl border border-gray-100 bg-white p-4 shadow-[0_20px_60px_-30px_rgba(23,24,28,0.25)] sm:p-6">
            <x-map.mexico-map instance-id="coverage-map" />
        </div>

        <div class="flex flex-col gap-10">
            <x-ui.section-heading
                eyebrow="Cobertura"
                title="Una red, no puntos aislados"
                subtitle="Las mismas ubicaciones del mapa forman parte de una sola red estratégica que conecta industria, logística e infraestructura en México."
            />

            <div class="flex flex-col items-start">
                <span class="font-display text-2xl font-bold text-carbon">México</span>
                <div class="my-3 h-8 w-px bg-gray-300" aria-hidden="true"></div>
                <span class="mb-3 text-xs font-semibold uppercase tracking-[0.2em] text-gray-400">Conexiones</span>

                <div class="grid w-full grid-cols-1 gap-3 sm:grid-cols-3">
                    <div data-reveal style="--reveal-delay: 0ms; border-color: var(--color-industria)" class="rounded-xl border p-4">
                        <p class="font-display font-semibold" style="color: var(--color-industria)">Industria</p>
                    </div>
                    <div data-reveal style="--reveal-delay: 80ms; border-color: var(--color-logistica)" class="rounded-xl border p-4">
                        <p class="font-display font-semibold" style="color: var(--color-logistica)">Logística</p>
                    </div>
                    <div data-reveal style="--reveal-delay: 160ms; border-color: var(--color-inmobiliaria)" class="rounded-xl border p-4">
                        <p class="font-display font-semibold" style="color: var(--color-inmobiliaria)">Infraestructura</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
