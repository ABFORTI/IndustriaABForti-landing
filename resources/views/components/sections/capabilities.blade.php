@props(['eyebrow', 'title', 'items', 'accent'])

<section class="py-16">
    <div class="container-grid flex flex-col gap-10">
        <x-ui.section-heading :eyebrow="$eyebrow" :title="$title" />

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($items as $index => $item)
                <div
                    data-reveal
                    class="rounded-2xl border border-gray-200 p-6 transition-colors hover:border-[var(--tab-accent)]"
                    style="--tab-accent: var(--color-{{ $accent }}); --reveal-delay: {{ ($index % 3) * 70 }}ms"
                >
                    <span class="text-xs font-semibold" style="color: var(--tab-accent)">
                        {{ sprintf('%02d', $index + 1) }}
                    </span>
                    <h3 class="mt-3 font-display text-base font-semibold text-carbon">
                        {{ $item }}
                    </h3>
                </div>
            @endforeach
        </div>
    </div>
</section>
