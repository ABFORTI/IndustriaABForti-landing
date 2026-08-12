@props([
    'variant' => 'primary', 
    'accent' => null,
    'href' => null,
])

@php
    
    $solid = match ($accent) {
        'industria' => 'bg-industria hover:bg-industria-soft focus-visible:outline-industria',
        'logistica' => 'bg-logistica hover:bg-logistica-soft focus-visible:outline-logistica',
        'inmobiliaria' => 'bg-inmobiliaria hover:bg-inmobiliaria-soft focus-visible:outline-inmobiliaria',
        default => 'bg-carbon hover:bg-gray-800 focus-visible:outline-carbon',
    };

    $outline = match ($accent) {
        'industria' => 'text-industria border-industria hover:bg-industria hover:text-white focus-visible:outline-industria',
        'logistica' => 'text-logistica border-logistica hover:bg-logistica hover:text-white focus-visible:outline-logistica',
        'inmobiliaria' => 'text-inmobiliaria border-inmobiliaria hover:bg-inmobiliaria hover:text-white focus-visible:outline-inmobiliaria',
        default => 'text-carbon border-carbon hover:bg-carbon hover:text-white focus-visible:outline-carbon',
    };

    $ghostText = match ($accent) {
        'industria' => 'text-industria hover:text-industria-soft',
        'logistica' => 'text-logistica hover:text-logistica-soft',
        'inmobiliaria' => 'text-inmobiliaria hover:text-inmobiliaria-soft',
        default => 'text-carbon hover:text-gray-600',
    };

    $base = 'inline-flex items-center justify-center gap-2 rounded-full px-6 py-3 text-sm font-semibold tracking-tight transition-colors duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2';

    $variantClasses = match ($variant) {
        'secondary' => "border {$outline} bg-transparent",
        'ghost' => "px-0 py-0 rounded-none {$ghostText}",
        'inverse' => 'border border-white/30 text-white bg-transparent hover:bg-white hover:text-carbon focus-visible:outline-white',
        default => "text-white {$solid}",
    };

    $classes = $variant === 'ghost' ? $variantClasses : "{$base} {$variantClasses}";
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
