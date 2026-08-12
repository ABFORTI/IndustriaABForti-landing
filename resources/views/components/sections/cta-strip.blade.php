@props(['accent' => null, 'size' => 'compact', 'anchor' => null, 'division' => null])

@php
    $isLarge = $size === 'large';

    $company = $division ? config("contact.division_map.{$division}") : null;
    $contactHref = $company ? route('contact.show', ['empresa' => $company]) : route('contact.show');
@endphp

<section class="{{ $isLarge ? 'py-24 sm:py-32' : 'py-16' }}">
    <div
        @if ($anchor) id="{{ $anchor }}" @endif
        class="container-grid relative overflow-hidden bg-carbon text-center text-white {{ $isLarge ? 'px-8 py-20 sm:px-16 sm:py-28' : 'px-8 py-14 sm:px-16 sm:py-16' }}"
    >
        @if ($isLarge)
            <div
                class="pointer-events-none absolute inset-0 opacity-30"
                style="background-color: #123456;"
                aria-hidden="true"
            ></div>
        @endif

        <div data-reveal class="relative flex flex-col items-center gap-6">
            <h2 class="font-display font-bold {{ $isLarge ? 'text-4xl sm:text-5xl lg:text-6xl' : 'text-2xl sm:text-3xl' }}">
                &iquest;Tienes un proyecto? Hagámoslo realidad.
            </h2>
            <p class="mx-auto max-w-xl text-white/70 {{ $isLarge ? 'text-base sm:text-lg' : 'text-sm sm:text-base' }}">
                Cuéntanos qué necesitas y nuestro equipo encontrará la solución adecuada para tu operación.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <x-ui.button :href="$contactHref" variant="inverse">
                    Solicitar información
                </x-ui.button>
            </div>
        </div>
    </div>
</section>
