@props(['division'])

<section class="pb-16 pt-16 sm:pb-20 sm:pt-20">
    <div class="container-grid flex flex-col gap-6">
        <span
            data-reveal-onload
            style="--reveal-delay: 0ms; color: var(--color-{{ $division['accent'] }})"
            class="w-fit text-xs font-semibold uppercase tracking-[0.2em]"
        >
            {{ $division['name'] }}
        </span>

        <h1
            data-reveal-onload
            style="--reveal-delay: 80ms"
            class="max-w-3xl font-display text-4xl font-bold leading-tight tracking-tight text-carbon sm:text-5xl lg:text-6xl"
        >
            {{ $division['headline'] }}
        </h1>

        <p data-reveal-onload style="--reveal-delay: 160ms" class="max-w-2xl text-base leading-relaxed text-gray-600 sm:text-lg">
            {{ $division['subheadline'] ?? $division['tagline'] }}
        </p>
    </div>
</section>
