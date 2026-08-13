@props(['division', 'slug' => null])

@php
    $hasBackground = !empty($division['background_image']);
    $eyebrowColor = $hasBackground ? '#ffffff' : "var(--color-{$division['accent']})";
    $contactCompany = $slug ? config("contact.division_map.{$slug}") : null;
    $contactHref = $contactCompany ? route('contact.show', ['empresa' => $contactCompany]) : route('contact.show');
@endphp

<section
    class="relative overflow-hidden pb-16 pt-16 sm:pb-20 sm:pt-20 {{ $hasBackground ? 'flex min-h-[480px] items-center sm:min-h-[560px] lg:min-h-[640px]' : '' }}"
>
    @if ($hasBackground)
        <img
            src="{{ asset($division['background_image']) }}"
            alt=""
            class="absolute inset-0 h-full w-full object-cover"
            loading="eager"
            fetchpriority="high"
            decoding="async"
        />
        <div class="absolute inset-0 bg-black/60" aria-hidden="true"></div>
    @endif

    <div class="container-grid relative flex w-full flex-col gap-6">
        @if (!empty($division['logo']))
            <div data-reveal-onload style="--reveal-delay: 0ms" class="w-fit">
                @if (!empty($division['reference']))
                    <a
                        href="{{ $division['reference'] }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center rounded-full bg-white px-4 py-2 shadow-sm transition-transform hover:scale-105"
                    >
                        <img src="{{ asset($division['logo']) }}" alt="Logo {{ $division['name'] }}" class="h-6 w-auto sm:h-7" />
                    </a>
                @else
                    <span class="inline-flex items-center rounded-full bg-white px-4 py-2 shadow-sm">
                        <img src="{{ asset($division['logo']) }}" alt="Logo {{ $division['name'] }}" class="h-6 w-auto sm:h-7" />
                    </span>
                @endif
            </div>
        @endif


        <span
            data-reveal-onload
            style="--reveal-delay: 60ms; color: {{ $eyebrowColor }}"
            class="w-fit text-xs font-semibold uppercase tracking-[0.2em]"
        >
            {{ $division['name'] }}
        </span>

        <h1
            data-reveal-onload
            style="--reveal-delay: 140ms"
            class="max-w-3xl font-display text-4xl font-bold leading-tight tracking-tight sm:text-5xl lg:text-6xl {{ $hasBackground ? 'text-white' : 'text-white' }}"
        >
            {{ $division['headline'] }}
        </h1>

        <p
            data-reveal-onload
            style="--reveal-delay: 220ms; color: #f2f2f2;"
            class="max-w-2xl text-base leading-relaxed sm:text-lg"
        >
            {{ $division['subheadline'] ?? $division['tagline'] }}
        </p>

        <div data-reveal-onload style="--reveal-delay: 300ms" class="pt-2">
            <x-ui.button :href="$contactHref" variant="inverse">
                Cotizar con {{ $division['name'] }}
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M9 6l6 6-6 6" />
                </svg>
            </x-ui.button>
        </div>
    </div>
</section>
