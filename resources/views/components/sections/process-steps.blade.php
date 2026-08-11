@props(['steps', 'accent'])

<section class="py-16">
    <div class="container-grid flex flex-col gap-10">
        <x-ui.section-heading eyebrow="Proceso" title="Cómo trabajamos" />

        <ol class="grid grid-cols-2 gap-6 sm:grid-cols-3 lg:grid-cols-6">
            @foreach ($steps as $step)
                <li
                    data-reveal
                    class="flex flex-col gap-3 border-t-2 pt-4"
                    style="border-color: var(--color-{{ $accent }}); --reveal-delay: {{ $loop->index * 70 }}ms"
                >
                    <span class="font-display text-2xl font-bold" style="color: var(--color-{{ $accent }})">
                        {{ $step['step'] }}
                    </span>
                    <h3 class="text-sm font-medium text-carbon">
                        {{ $step['label'] }}
                    </h3>
                </li>
            @endforeach
        </ol>
    </div>
</section>
