@props(['items', 'accent', 'accentSoft' => null])

@php
    // Soporta tanto items simples (string) como items enriquecidos
    // (label, icon, image, description) para alimentar el carrusel interactivo.
    // Si la imagen aún no existe en disco, cae de vuelta al icono para no
    // romper el layout mientras se suben las fotos definitivas.
    $slugged = collect($items)->map(function ($item, $index) {
        $isRich = is_array($item);
        $image = $isRich ? ($item['image'] ?? null) : null;
        $imageExists = $image && file_exists(public_path($image));

        return [
            'slug' => 'industry-' . $index,
            'label' => $isRich ? $item['label'] : $item,
            'icon' => $isRich ? ($item['icon'] ?? null) : null,
            'image' => $imageExists ? $image : null,
            'description' => $isRich ? ($item['description'] ?? null) : null,
        ];
    });

    $accentSoft ??= $accent;
    $firstSlug = $slugged->first()['slug'] ?? null;
@endphp

<section class="py-16">
    <div class="container-grid flex flex-col gap-10">
        <x-ui.section-heading eyebrow="Cobertura" title="Industrias que atendemos" />

        <div
            data-industries-carousel
            data-reveal
            class="flex flex-col gap-8 lg:flex-row lg:gap-12"
            style="--tab-accent: var(--color-{{ $accent }}); --tab-accent-soft: var(--color-{{ $accentSoft }})"
        >
            {{-- Pills --}}
            <div
                role="tablist"
                aria-label="Industrias atendidas"
                class="flex flex-wrap gap-3 lg:w-56 lg:shrink-0 lg:flex-col lg:flex-nowrap"
            >
                @foreach ($slugged as $item)
                    <button
                        type="button"
                        role="tab"
                        id="{{ $item['slug'] }}-tab"
                        aria-controls="{{ $item['slug'] }}-panel"
                        data-industry-tab
                        data-industry="{{ $item['slug'] }}"
                        aria-selected="{{ $item['slug'] === $firstSlug ? 'true' : 'false' }}"
                        tabindex="{{ $item['slug'] === $firstSlug ? '0' : '-1' }}"
                        class="industry-pill {{ $item['slug'] === $firstSlug ? 'is-active' : '' }} inline-flex items-center gap-2 rounded-full border border-gray-200 px-4 py-2 text-left text-sm text-carbon transition-colors"
                    >
                        <span class="industry-pill__dot h-1.5 w-1.5 shrink-0 rounded-full"></span>
                        {{ $item['label'] }}
                    </button>
                @endforeach
            </div>

            {{-- Panel / carrusel: apilados en la misma celda, transición por opacidad --}}
            <div class="grid flex-1">
                @foreach ($slugged as $item)
                    <div
                        role="tabpanel"
                        id="{{ $item['slug'] }}-panel"
                        aria-labelledby="{{ $item['slug'] }}-tab"
                        tabindex="0"
                        data-industry-panel
                        data-industry="{{ $item['slug'] }}"
                        class="industry-panel {{ $item['slug'] === $firstSlug ? 'is-active' : '' }} col-start-1 row-start-1"
                    >
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-[minmax(0,220px)_1fr] sm:items-center">
                            @if ($item['image'])
                                <div class="aspect-[4/3] w-full overflow-hidden rounded-2xl bg-gray-100 sm:aspect-square">
                                    <img
                                        src="{{ asset($item['image']) }}"
                                        alt="{{ $item['label'] }}"
                                        loading="lazy"
                                        decoding="async"
                                        class="h-full w-full object-cover"
                                    />
                                </div>
                            @else
                                <div class="industry-panel__visual flex aspect-[4/3] flex-col items-center justify-center gap-3 rounded-2xl p-6 text-center sm:aspect-square">
                                    @if ($item['icon'])
                                        <x-ui.icon :name="$item['icon']" class="h-10 w-10" />
                                    @endif
                                </div>
                            @endif

                            <div class="flex flex-col gap-3">
                                <h3 class="font-display text-xl font-semibold text-carbon sm:text-2xl">
                                    {{ $item['label'] }}
                                </h3>
                                @if ($item['description'])
                                    <p class="max-w-md text-sm leading-relaxed text-gray-600 sm:text-base">
                                        {{ $item['description'] }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
