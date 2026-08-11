@props(['items', 'accent', 'accentSoft'])

{{--
    BRIEF §10/§25: todavía no hay proyectos reales que mostrar, así que se
    usan placeholders elegantes y claramente marcados por categoría, en vez
    de inventar proyectos o clientes.
--}}
<section class="py-16">
    <div class="container-grid flex flex-col gap-8">
        <x-ui.section-heading
            eyebrow="Proyectos"
            title="Tipos de desarrollo"
            subtitle="Sin proyectos publicados todavía. Estas son las categorías que desarrollamos; se sustituirán por casos reales cuando estén disponibles."
        />

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($items as $item)
                <div
                    data-reveal
                    class="division-panel__visual flex aspect-[4/3] flex-col items-center justify-center gap-3 rounded-2xl border border-gray-100 p-6 text-center"
                    style="--tab-accent: var(--color-{{ $accent }}); --tab-accent-soft: var(--color-{{ $accentSoft }}); --reveal-delay: {{ ($loop->index % 3) * 80 }}ms"
                >
                    <span class="text-xs font-semibold uppercase tracking-widest" style="color: var(--tab-accent)">
                        Placeholder
                    </span>
                    <h3 class="font-display text-base font-semibold text-carbon">
                        {{ $item }}
                    </h3>
                </div>
            @endforeach
        </div>
    </div>
</section>
