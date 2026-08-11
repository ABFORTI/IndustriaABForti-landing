@props([
    'instanceId' => 'mexico-map',
    'locations' => null,
])

@php
    $locations = $locations ?? config('locations');

    $svgPath = resource_path('svg/mexico-map.svg');
    $svg = null;

    if (is_file($svgPath)) {
        $svg = file_get_contents($svgPath);

        $svg = preg_replace('/<\?xml.*?\?>/s', '', $svg);
        $svg = preg_replace('/<!--.*?-->/s', '', $svg);

        $svg = preg_replace('/<g id="points">.*?<\/g>\s*/s', '', $svg);

        $svg = preg_replace('/\s(width|height)="[^"]*"/', '', $svg);

        $svg = preg_replace_callback(
            '/<(path|circle)([^>]*?)\sid="(MX[A-Z]{3})"/',
            function (array $m) use ($instanceId) {
                $prefix = $m[1] === 'path' ? 'state' : 'point';

                return "<{$m[1]}{$m[2]} id=\"{$instanceId}-{$prefix}-{$m[3]}\"";
            },
            $svg
        );

        $svg = str_replace('<g id="features">', '<g id="'.$instanceId.'-features">', $svg);
        $svg = str_replace('<g id="label_points">', '<g id="'.$instanceId.'-label_points">', $svg);

        foreach ($locations as $location) {
            if (! $location['state_svg_id']) {
                continue;
            }

            // Cada ubicación toma el color de su primera división real
            // (BRIEF §16: los acentos son de división, no del mapa en sí) —
            // así el mapa se ve más colorido sin inventar una paleta nueva.
            $accent = $location['divisions'][0] ?? 'logistica';

            $stateId = $instanceId.'-state-'.$location['state_svg_id'];
            $svg = str_replace(
                'id="'.$stateId.'"',
                'id="'.$stateId.'" data-active-location tabindex="0" role="button" aria-label="'.e($location['city']).'"'
                    .' style="--marker-color: var(--color-'.$accent.'); --marker-color-soft: var(--color-'.$accent.'-soft);"',
                $svg
            );
        }

        $svg = preg_replace(
            '/<svg /',
            '<svg role="img" aria-label="Mapa de México con la red de ubicaciones del grupo" class="w-full h-auto" ',
            $svg,
            1
        );

        $svg = trim($svg);
    }
@endphp

<div class="relative" data-map-instance="{{ $instanceId }}">
    @if ($svg)
        {!! $svg !!}

        <svg
            class="pointer-events-none absolute inset-0 h-full w-full"
            viewBox="0 0 1000 630"
            preserveAspectRatio="xMidYMid meet"
            aria-hidden="true"
            data-map-connections
        ></svg>

        <div class="pointer-events-none absolute inset-0" data-map-markers>
            @foreach ($locations as $location)
                @continue(! $location['state_svg_id'])

                @php $accent = $location['divisions'][0] ?? 'logistica'; @endphp

                <button
                    type="button"
                    data-reveal
                    class="map-marker pointer-events-auto"
                    data-marker
                    data-slug="{{ $location['slug'] }}"
                    data-accent="{{ $accent }}"
                    data-state-id="{{ $instanceId }}-state-{{ $location['state_svg_id'] }}"
                    data-point-id="{{ $instanceId }}-point-{{ $location['state_svg_id'] }}"
                    data-city="{{ $location['city'] }}"
                    data-state-name="{{ $location['state'] }}"
                    data-highlights="{{ implode(' · ', $location['highlights']) }}"
                    style="--marker-color: var(--color-{{ $accent }}); --marker-color-soft: var(--color-{{ $accent }}-soft); --reveal-delay: {{ $loop->index * 100 }}ms"
                    aria-label="{{ $location['city'] }}: {{ implode(', ', $location['highlights']) }}"
                >
                    <span class="map-marker__pulse map-marker__pulse--delay" aria-hidden="true"></span>
                    <span class="map-marker__pulse" aria-hidden="true"></span>
                    <span class="map-marker__dot" aria-hidden="true"></span>
                </button>
            @endforeach
        </div>

        <div class="map-tooltip" data-map-tooltip id="{{ $instanceId }}-tooltip" role="tooltip" hidden></div>
    @else
        <div class="flex aspect-[1000/630] w-full items-center justify-center rounded-2xl bg-gray-100 text-sm text-gray-400">
            Mapa no disponible
        </div>
    @endif
</div>
