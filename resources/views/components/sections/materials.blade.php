@props(['eyebrow' => null, 'title', 'items', 'accent'])

@php
    $prepared = collect($items)->map(function ($item, $index) {
        $isRich = is_array($item);
        $image = $isRich ? ($item['image'] ?? null) : null;
        $imageExists = $image && file_exists(public_path($image));

        return [
            'label' => $isRich ? $item['label'] : $item,
            'description' => $isRich ? ($item['description'] ?? null) : null,
            'image' => $imageExists ? $image : null,
        ];
    });
@endphp

<section class="py-10">
    <div class="container-grid flex flex-col gap-6">
        <x-ui.section-heading :eyebrow="$eyebrow" :title="$title" />

        <div
            data-reveal
            class="grid grid-cols-3 gap-3 sm:grid-cols-4 lg:grid-cols-7"
            style="--tab-accent: var(--color-{{ $accent }})"
        >
            @foreach ($prepared as $index => $item)
                <div
                    @if ($item['description']) title="{{ $item['description'] }}" @endif
                    class="group relative flex aspect-square max-w-[9rem] flex-col overflow-hidden rounded-xl border border-gray-200 bg-gray-100 transition-colors hover:border-[var(--tab-accent)]"
                    style="--reveal-delay: {{ ($index % 4) * 60 }}ms"
                >
                    @if ($item['image'])
                        <img
                            src="{{ asset($item['image']) }}"
                            alt="{{ $item['label'] }}"
                            loading="lazy"
                            decoding="async"
                            class="absolute inset-0 h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
                        />
                        <div class="absolute inset-0 bg-gradient-to-t from-carbon/80 via-carbon/10 to-transparent"></div>
                    @else
                        <div class="absolute inset-0 flex items-center justify-center">
                            <x-ui.icon name="layers" class="h-5 w-5 text-gray-300 sm:h-6 sm:w-6" />
                        </div>
                    @endif

                    <div class="relative mt-auto flex flex-col gap-0.5 p-2 sm:p-2.5">
                        <span class="font-display text-xs font-bold tracking-tight sm:text-sm {{ $item['image'] ? 'text-white' : 'text-carbon' }}">
                            {{ $item['label'] }}
                        </span>
                        @if ($item['description'])
                            <span class="hidden text-[0.65rem] leading-snug sm:block {{ $item['image'] ? 'text-white/80' : 'text-gray-500' }}">
                                {{ $item['description'] }}
                            </span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
