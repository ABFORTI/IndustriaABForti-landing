@props(['division'])

@php
    $flow = [
        ['icon' => 'pin', 'label' => 'Origen'],
        ['icon' => 'truck', 'label' => 'Transporte'],
        ['icon' => 'stamp', 'label' => 'Aduana'],
        ['icon' => 'anchor', 'label' => 'Puerto'],
        ['icon' => 'building', 'label' => 'Centro logístico'],
        ['icon' => 'user', 'label' => 'Cliente'],
    ];

    $hasBackground = !empty($division['background_image']);
    $eyebrowColor = $hasBackground ? '#ffffff' : "var(--color-{$division['accent']})";
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

    <div class="container-grid relative flex w-full flex-col gap-10">
        <div class="flex flex-col gap-6">
            <span
                data-reveal-onload
                style="--reveal-delay: 0ms; color: var(--color-logistica-soft)"
                class="w-fit text-xs font-semibold uppercase tracking-[0.2em]"
            >
                {{ $division['name'] }}
            </span>

            <h1
                data-reveal-onload
                style="--reveal-delay: 80ms"
                class="max-w-3xl font-display text-4xl font-bold leading-tight tracking-tight text-white sm:text-5xl lg:text-6xl"
            >
                {{ $division['headline'] }}
            </h1>

            <p data-reveal-onload style="--reveal-delay: 160ms; color: #d4d4d8" class="max-w-2xl text-base leading-relaxed sm:text-lg">
                Una red logística integrada que conecta puertos, ciudades, centros de trabajo y sectores industriales en todo México.
            </p>

            <div data-reveal-onload style="--reveal-delay: 240ms" class="pt-2">
                <x-ui.button href="#red-logistica" variant="inverse">
                    Explorar nuestra red logística
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M12 5v14M5 12l7 7 7-7" />
                    </svg>
                </x-ui.button>
            </div>
        </div>

        <div
            data-reveal
            class="grid grid-cols-3 gap-x-2 gap-y-8 rounded-3xl border border-white/10 bg-white/5 p-6 backdrop-blur-sm sm:grid-cols-6 sm:gap-4 sm:p-8"
        >
            @foreach ($flow as $index => $step)
                <div class="relative flex flex-col items-center gap-3 text-center">
                    <span class="flex h-14 w-14 items-center justify-center rounded-full bg-white/10 text-white ring-1 ring-white/15">
                        <x-ui.icon :name="$step['icon']" class="h-6 w-6" />
                    </span>
                    <span class="text-xs font-medium text-white/80 sm:text-sm">{{ $step['label'] }}</span>

                    @if (! $loop->last)
                        <svg
                            class="pointer-events-none absolute top-7 left-[calc(50%+2.25rem)] hidden h-4 w-[calc(100%-2.5rem)] text-white/30 sm:block"
                            viewBox="0 0 100 10"
                            preserveAspectRatio="none"
                            aria-hidden="true"
                        >
                            <line x1="0" y1="5" x2="94" y2="5" stroke="currentColor" stroke-width="2" stroke-dasharray="5 5" />
                            <path d="M90 1L98 5L90 9" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
