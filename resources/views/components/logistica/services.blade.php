@props(['services'])

<section class="bg-white py-16 sm:py-20">
    <div class="container-grid flex flex-col gap-10">

        <x-ui.section-heading
            eyebrow="Servicios"
            title="Capacidades compartidas de la red"
            subtitle="Una red integral para mover, almacenar y gestionar mercancías de principio a fin."
            accent="logistica"
        />

        <div class="grid grid-cols-1 gap-3 sm:flex sm:flex-wrap sm:justify-center">
            @foreach ($services as $index => $service)
                <article
                    data-reveal
                    style="--reveal-delay: {{ $index * 60 }}ms"
                    class="service-card group relative flex w-full flex-col overflow-hidden rounded-xl border border-gray-200 bg-white transition-all duration-300 hover:-translate-y-1 hover:border-logistica/50 hover:shadow-lg hover:shadow-logistica/10 sm:w-[calc(50%-0.375rem)] md:w-[calc(33.333%-0.5rem)] lg:w-44"
                >
                    @if (! empty($service['image']))
                        <div class="relative aspect-[16/9] w-full overflow-hidden sm:aspect-[16/10]">
                            <img
                                src="{{ asset($service['image']) }}"
                                alt=""
                                loading="lazy"
                                decoding="async"
                                class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
                            />
                            <div class="absolute inset-0 bg-gradient-to-t from-logistica/85 via-logistica/10 to-transparent"></div>
                            <span class="absolute bottom-2 left-2 flex h-7 w-7 items-center justify-center rounded-md bg-white/15 text-white ring-1 ring-white/30 backdrop-blur-sm">
                                <x-ui.icon :name="$service['icon']" class="h-3.5 w-3.5" />
                            </span>
                            <span class="absolute right-2 top-2 font-mono text-[10px] font-semibold tracking-widest text-white/70">
                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </span>
                        </div>
                    @endif

                    <div class="flex flex-1 flex-col gap-2 p-4 sm:p-3">
                        @unless (! empty($service['image']))
                            <div class="flex items-center justify-between">
                                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-logistica/10 text-logistica transition-colors duration-300 group-hover:bg-logistica group-hover:text-white sm:h-8 sm:w-8">
                                    <x-ui.icon :name="$service['icon']" class="h-4 w-4" />
                                </span>
                                <span class="font-mono text-[10px] font-semibold tracking-widest text-gray-300">
                                    {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                </span>
                            </div>
                        @endunless

                        <div class="flex flex-col gap-1">
                            <h3 class="font-display text-sm font-bold text-carbon sm:text-xs">
                                {{ $service['label'] }}
                            </h3>
                            <p class="text-[13px] leading-relaxed text-gray-500 sm:line-clamp-3 sm:text-[11px]">
                                {{ $service['description'] }}
                            </p>
                        </div>

                        <span class="mt-auto h-px w-6 bg-logistica/30 transition-all duration-300 group-hover:w-full group-hover:bg-logistica"></span>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
