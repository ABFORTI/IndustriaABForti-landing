@props(['name'])

@php
    $paths = match ($name) {
        'cube' => ['M12 3 20 7.5V16.5L12 21L4 16.5V7.5Z', 'M4 7.5 12 12L20 7.5', 'M12 12V21'],
        'truck' => ['M2 7H14V16H2Z', 'M14 10H18L21 13V16H14Z', 'M6 16A2 2 0 1 0 6 20A2 2 0 1 0 6 16Z', 'M17 16A2 2 0 1 0 17 20A2 2 0 1 0 17 16Z'],
        'building' => ['M5 3H19V21H5Z', 'M9 7H10', 'M14 7H15', 'M9 11H10', 'M14 11H15', 'M9 15H10', 'M14 15H15'],
        // Iconografía de "Por qué nosotros"
        'shield' => ['M12 2 20 6V12C20 16 16.5 19.5 12 21C7.5 19.5 4 16 4 12V6Z'],
        'link' => ['M3 8A4 4 0 0 1 7 4H8', 'M21 16A4 4 0 0 1 17 20H16', 'M8 4H17A4 4 0 0 1 21 8V16A4 4 0 0 1 17 20H7A4 4 0 0 1 3 16V8A4 4 0 0 1 7 4Z', 'M8 12H16'],
        'chip' => ['M7 7H17V17H7Z', 'M9 3V7', 'M15 3V7', 'M9 17V21', 'M15 17V21', 'M3 9H7', 'M3 15H7', 'M17 9H21', 'M17 15H21'],
        'pin' => ['M12 21S19 13.5 19 9A7 7 0 1 0 5 9C5 13.5 12 21 12 21Z', 'M12 11.3A2.3 2.3 0 1 0 12 6.7A2.3 2.3 0 1 0 12 11.3Z'],
        'sliders' => ['M4 6H20', 'M4 12H20', 'M4 18H20', 'M9 6A2 2 0 1 0 9 6.01', 'M15 12A2 2 0 1 0 15 12.01', 'M10 18A2 2 0 1 0 10 18.01'],
        // Iconografía de "Industrias que atendemos" 
        'food' => ['M4 9H20L18 21H6Z', 'M8 9C8 6 10 4 12 4C14 4 16 6 16 9'],
        'car' => ['M2 15V11L5 7H15L18 11V15Z', 'M7 15A2 2 0 1 0 7 19A2 2 0 1 0 7 15Z', 'M13 15A2 2 0 1 0 13 19A2 2 0 1 0 13 15Z'],
        'leaf' => ['M4 20C4 20 4 10 12 6C20 10 20 20 20 20', 'M4 20C10 20 16 16 20 20'],
        'bag' => ['M5 8H19L18 21H6Z', 'M8 8V6A4 4 0 0 1 16 6V8'],
        'cross' => ['M5 5H19V19H5Z', 'M12 8V16', 'M8 12H16'],
        'droplet' => ['M12 3C12 3 6 11 6 15A6 6 0 0 0 18 15C18 11 12 3 12 3Z'],
        // Iconografía de la sección Logística 
        'anchor' => ['M12 3A2 2 0 1 0 12 3.01', 'M12 6V21', 'M5 13C5 17.5 8 20.5 12 21C16 20.5 19 17.5 19 13', 'M4 10H8', 'M16 10H20'],
        'stamp' => ['M7 3H17V9H7Z', 'M9 9V13H15V9', 'M5 20H19', 'M9 16H15'],
        'user' => ['M12 12A4 4 0 1 0 12 4A4 4 0 1 0 12 12Z', 'M4 21C4 16.5 7.5 14 12 14C16.5 14 20 16.5 20 21'],
        'layers' => ['M4 6H14V11H4Z', 'M7 13H17V18H7Z'],
        'boxes' => ['M4 4H10.5V10.5H4Z', 'M13.5 4H20V10.5H13.5Z', 'M4 13.5H10.5V20H4Z', 'M13.5 13.5H20V20H13.5Z'],
        'shuffle' => ['M3 6H12L9 3', 'M3 6L9 9', 'M21 18H12L15 21', 'M21 18L15 15'],
        default => [],
    };
@endphp

<svg
    {{ $attributes->merge(['class' => 'h-8 w-8']) }}
    viewBox="0 0 24 24"
    fill="none"
    stroke="currentColor"
    stroke-width="1.4"
    stroke-linecap="round"
    stroke-linejoin="round"
    aria-hidden="true"
>
    @foreach ($paths as $d)
        <path d="{{ $d }}" />
    @endforeach
</svg>
