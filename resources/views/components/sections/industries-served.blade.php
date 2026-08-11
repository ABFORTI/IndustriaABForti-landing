@props(['items', 'accent'])

{{-- BRIEF §8: "Industrias que atendemos" --}}
<section class="py-16">
    <div class="container-grid flex flex-col gap-8">
        <x-ui.section-heading eyebrow="Cobertura" title="Industrias que atendemos" />

        <div data-reveal class="flex flex-wrap gap-3">
            @foreach ($items as $item)
                <span class="inline-flex items-center gap-2 rounded-full border border-gray-200 px-4 py-2 text-sm text-carbon">
                    <span class="h-1.5 w-1.5 rounded-full" style="background: var(--color-{{ $accent }})"></span>
                    {{ $item }}
                </span>
            @endforeach
        </div>
    </div>
</section>
