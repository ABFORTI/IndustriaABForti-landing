@php
    $navLinks = [
        ['label' => 'Industria', 'href' => route('divisions.show', 'industria')],
        ['label' => 'Logística', 'href' => route('divisions.show', 'logistica')],
        ['label' => 'Contacto', 'href' => route('contact.show')],
    ];
@endphp

<header id="site-header" class="sticky top-0 z-50 border-b border-transparent bg-white/95 py-5 backdrop-blur-sm">
    <div class="container-grid flex items-center justify-between gap-6">
        <a
            href="{{ route('home') }}"
            class="rounded-sm font-display text-lg font-bold tracking-tight text-carbon focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-carbon"
        >
            Business AB Forti<span class="text-gray-400">.</span>
        </a>

        <nav class="hidden items-center gap-8 lg:flex" aria-label="Principal">
            @foreach ($navLinks as $link)
                <a
                    href="{{ $link['href'] }}"
                    class="rounded-sm text-sm font-medium text-carbon/80 transition-colors hover:text-carbon focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-carbon"
                >
                    {{ $link['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="hidden lg:block">
            <x-ui.button :href="route('contact.show')" class="px-5! py-2.5! text-xs">
                Hablemos de tu proyecto
            </x-ui.button>
        </div>

        <button
            id="mobile-menu-open"
            type="button"
            class="inline-flex h-10 w-10 items-center justify-center rounded-full text-carbon focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-carbon lg:hidden"
            aria-expanded="false"
            aria-controls="mobile-menu"
            aria-label="Abrir menú"
        >
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                <path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16" />
            </svg>
        </button>
    </div>
</header>

<div
    id="mobile-menu"
    class="fixed inset-0 z-[60] flex -translate-y-4 flex-col bg-carbon text-white opacity-0 pointer-events-none transition-all duration-300 ease-out lg:hidden"
    role="dialog"
    aria-modal="true"
    aria-label="Menú de navegación"
>
    <div class="container-grid flex items-center justify-between py-5">
        <span class="font-display text-lg font-bold tracking-tight text-white">
            Business AB Forti<span class="text-white/40">.</span>
        </span>

        <button
            id="mobile-menu-close"
            type="button"
            class="inline-flex h-10 w-10 items-center justify-center rounded-full text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white"
            aria-label="Cerrar menú"
        >
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                <path stroke-linecap="round" d="M6 6l12 12M18 6L6 18" />
            </svg>
        </button>
    </div>

    <nav class="container-grid flex flex-1 flex-col justify-center gap-1 pb-16" aria-label="Principal móvil">
        @foreach ($navLinks as $link)
            <a
                href="{{ $link['href'] }}"
                class="border-b border-white/10 py-4 font-display text-3xl font-semibold tracking-tight text-white transition-colors hover:text-white/70 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-white"
            >
                {{ $link['label'] }}
            </a>
        @endforeach

        <div class="pt-8">
            <x-ui.button :href="route('contact.show')" class="w-full justify-center">
                Hablemos de tu proyecto
            </x-ui.button>
        </div>
    </nav>
</div>
