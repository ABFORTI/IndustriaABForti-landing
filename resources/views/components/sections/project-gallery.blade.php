@props(['items', 'accent', 'accentSoft'])

@php
    $normalized = collect($items)->map(function ($item) {
        $isRich = is_array($item);
        $image = $isRich ? ($item['image'] ?? null) : null;
        $imageExists = $image && file_exists(public_path($image));

        return [
            'label' => $isRich ? ($item['label'] ?? '') : $item,
            'image' => $imageExists ? $image : null,
        ];
    });

    $hasAnyImage = $normalized->contains(fn ($item) => $item['image']);
@endphp

<section class="py-16">
    <div class="container-grid flex flex-col gap-8">
        <x-ui.section-heading
            eyebrow="Proyectos"
            title="Tipos de desarrollo"
            :subtitle="$hasAnyImage
                ? 'Estas son las categorías de desarrollo en las que trabajamos.'
                : 'Sin proyectos publicados todavía. Estas son las categorías que desarrollamos; se sustituirán por casos reales cuando estén disponibles.'"
        />

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($normalized as $item)
                @if ($item['image'])
                    <div
                        data-reveal
                        class="relative flex aspect-[4/3] flex-col items-end justify-end overflow-hidden rounded-2xl border border-gray-100"
                        style="--reveal-delay: {{ ($loop->index % 3) * 80 }}ms"
                    >
                        <img
                            src="{{ asset($item['image']) }}"
                            alt="{{ $item['label'] }}"
                            loading="lazy"
                            decoding="async"
                            class="absolute inset-0 h-full w-full object-cover"
                        />
                        <div class="relative flex w-full items-center bg-gradient-to-t from-black/70 via-black/10 to-transparent p-4">
                            <h3 class="font-display text-base font-semibold text-white">
                                {{ $item['label'] }}
                            </h3>
                        </div>
                    </div>
                @else
                    <div
                        data-reveal
                        class="division-panel__visual flex aspect-[4/3] flex-col items-center justify-center gap-3 rounded-2xl border border-gray-100 p-6 text-center"
                        style="--tab-accent: var(--color-{{ $accent }}); --tab-accent-soft: var(--color-{{ $accentSoft }}); --reveal-delay: {{ ($loop->index % 3) * 80 }}ms"
                    >
                        <span class="text-xs font-semibold uppercase tracking-widest" style="color: var(--tab-accent)">
                            Placeholder
                        </span>
                        <h3 class="font-display text-base font-semibold text-carbon">
                            {{ $item['label'] }}
                        </h3>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
