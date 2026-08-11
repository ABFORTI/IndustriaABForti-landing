@props([
    'eyebrow' => null,
    'title',
    'subtitle' => null,
    'align' => 'left', 
    'accent' => null,
])

@php
    $eyebrowColor = match ($accent) {
        'industria' => 'text-industria',
        'logistica' => 'text-logistica',
        'inmobiliaria' => 'text-inmobiliaria',
        default => 'text-gray-500',
    };

    $alignClasses = $align === 'center' ? 'text-center items-center mx-auto' : 'text-left items-start';
@endphp

<div data-reveal {{ $attributes->merge(['class' => "flex flex-col gap-4 {$alignClasses}"]) }}>
    @if ($eyebrow)
        <span class="text-xs font-semibold uppercase tracking-[0.2em] {{ $eyebrowColor }}">
            {{ $eyebrow }}
        </span>
    @endif

    <h2 class="font-display text-3xl font-bold leading-tight tracking-tight text-carbon sm:text-4xl lg:text-5xl">
        {{ $title }}
    </h2>

    @if ($subtitle)
        <p class="max-w-2xl text-base leading-relaxed text-gray-600 sm:text-lg">
            {{ $subtitle }}
        </p>
    @endif
</div>
