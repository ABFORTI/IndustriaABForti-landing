@props(['eyebrow', 'title', 'items', 'accent'])

<section class="py-16">
    <div class="container-grid flex flex-col gap-10">
        <x-ui.section-heading :eyebrow="$eyebrow" :title="$title" />

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($items as $index => $item)
                @php
                    $isImageCard = is_array($item);
                    $label = $isImageCard ? $item['label'] : $item;
                    $image = $isImageCard ? ($item['image'] ?? null) : null;
                    $advantages = $isImageCard ? ($item['advantages'] ?? []) : [];
                @endphp

                <button
                    type="button"
                    data-reveal
                    @if (count($advantages)) data-product-trigger @endif
                    data-product-label="{{ $label }}"
                    data-product-image="{{ $image ? asset($image) : '' }}"
                    data-product-advantages="{{ json_encode($advantages, JSON_UNESCAPED_UNICODE) }}"
                    aria-haspopup="{{ count($advantages) ? 'dialog' : 'false' }}"
                    class="group block w-full overflow-hidden rounded-2xl border border-gray-200 text-left transition-colors hover:border-[var(--tab-accent)] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[var(--tab-accent)] {{ count($advantages) ? 'cursor-pointer' : 'cursor-default' }}"
                    style="--tab-accent: var(--color-{{ $accent }}); --reveal-delay: {{ ($index % 3) * 70 }}ms"
                >
                    @if ($image)
                        <div class="aspect-[4/3] w-full overflow-hidden bg-gray-100">
                            <img
                                src="{{ asset($image) }}"
                                alt="{{ $label }}"
                                loading="lazy"
                                decoding="async"
                                class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
                            />
                        </div>
                    @endif

                    <div class="p-6">
                        <span class="text-xs font-semibold" style="color: var(--tab-accent)">
                            {{ sprintf('%02d', $index + 1) }}
                        </span>
                        <h3 class="mt-3 font-display text-base font-semibold text-carbon">
                            {{ $label }}
                        </h3>
                        @if (count($advantages))
                            <span class="mt-2 inline-flex items-center gap-1 text-xs font-medium text-gray-400 transition-colors group-hover:text-[var(--tab-accent)]">
                                Ver ventajas
                                <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M9 6l6 6-6 6" />
                                </svg>
                            </span>
                        @endif
                    </div>
                </button>
            @endforeach
        </div>
    </div>

    {{-- Modal de ventajas de producto: una sola instancia, poblada por JS
    con los data-product-* de la tarjeta que se haya clickeado. --}}
    <div
        data-product-modal
        class="fixed inset-0 z-[70] flex items-center justify-center p-4 opacity-0 pointer-events-none transition-opacity duration-300"
        style="--tab-accent: var(--color-{{ $accent }})"
    >
        <div data-product-modal-backdrop class="absolute inset-0 bg-carbon/70 backdrop-blur-sm"></div>

        <div
            role="dialog"
            aria-modal="true"
            aria-labelledby="product-modal-title"
            class="relative flex max-h-[85vh] w-full max-w-lg scale-95 flex-col overflow-hidden rounded-2xl bg-white shadow-2xl transition-transform duration-300"
            data-product-modal-panel
        >
            <button
                type="button"
                data-product-modal-close
                aria-label="Cerrar"
                class="absolute right-4 top-4 z-10 inline-flex h-9 w-9 items-center justify-center rounded-full bg-white/90 text-carbon shadow-sm transition-colors hover:bg-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-carbon"
            >
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                    <path d="M6 6l12 12M18 6L6 18" />
                </svg>
            </button>

            <div data-product-modal-image class="aspect-[16/9] w-full overflow-hidden bg-gray-100">
                <img data-product-modal-img src="" alt="" class="h-full w-full object-cover" />
            </div>

            <div class="flex flex-col gap-4 overflow-y-auto p-6 sm:p-8">
                <h3 id="product-modal-title" data-product-modal-title class="font-display text-2xl font-bold text-carbon"></h3>
                <ul data-product-modal-list class="flex flex-col gap-3"></ul>
            </div>
        </div>
    </div>
</section>
