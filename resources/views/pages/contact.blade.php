@php
    $sidebarCards = [
        'ab-forti' => ['icon' => 'shield', 'accent' => null],
        'innovet' => ['icon' => 'cube', 'accent' => 'industria'],
        'upperlogistics' => ['icon' => 'truck', 'accent' => 'logistica'],
        'controlup' => ['icon' => 'map', 'accent' => 'logistica'],
        'inmobiliaria' => ['icon' => 'building', 'accent' => 'inmobiliaria'],
    ];
@endphp

<x-layouts.app
    title="Contacto — Habla con AB Forti, Innovet o Upper Logistics"
    description="Envía tu solicitud y elige a quién quieres contactar: AB Forti, Innovet o Upper Logistics."
>
    <section class="overflow-hidden bg-carbon pb-16 pt-16 text-white sm:pb-20 sm:pt-20">
        <div class="container-grid flex flex-col gap-4">
            <span data-reveal-onload style="--reveal-delay: 0ms" class="text-xs font-semibold uppercase tracking-[0.2em] text-white/60">
                Contacto
            </span>
            <h1 data-reveal-onload style="--reveal-delay: 80ms" class="max-w-2xl font-display text-4xl font-bold leading-tight tracking-tight sm:text-5xl">
                ¿Tienes un proyecto? Hagámoslo realidad.
            </h1>
            <p data-reveal-onload style="--reveal-delay: 160ms" class="max-w-xl text-base leading-relaxed text-white/70 sm:text-lg">
                Cuéntanos qué necesitas. Elige a quién va dirigido tu mensaje y nuestro equipo te responderá directamente.
            </p>
        </div>
    </section>

    <section class="py-16 sm:py-20">
        <div class="container-grid grid grid-cols-1 gap-10 lg:grid-cols-[3fr_2fr] lg:gap-14">

            <div data-reveal class="flex flex-col gap-6">
                @if (session('status') === 'sent')
                    <div class="rounded-2xl border p-5 text-sm text-carbon" style="border-color: color-mix(in srgb, var(--color-logistica) 35%, white); background: color-mix(in srgb, var(--color-logistica) 6%, white);">
                        <strong class="font-semibold">¡Gracias! Tu mensaje fue enviado.</strong>
                        Nuestro equipo se pondrá en contacto contigo muy pronto.
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}" class="flex flex-col gap-5 rounded-3xl border border-gray-200 p-6 sm:p-8" novalidate>
                    @csrf

                    {{-- Honeypot: oculto para personas, visible para bots --}}
                    <div class="absolute left-[-9999px] top-auto h-0 w-0 overflow-hidden" aria-hidden="true">
                        <label for="website">Deja este campo vacío</label>
                        <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="name" class="text-sm font-semibold text-carbon">Nombre completo</label>
                        <input
                            type="text" id="name" name="name" required maxlength="120"
                            value="{{ old('name') }}"
                            class="rounded-xl border border-gray-300 px-4 py-3 text-sm text-carbon transition-colors focus:border-carbon focus:outline-none @error('name') border-red-500 @enderror"
                            placeholder="Tu nombre y apellido"
                        >
                        @error('name') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="company" class="text-sm font-semibold text-carbon">Empresa</label>
                        <select
                            id="company" name="company" required
                            class="rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-carbon transition-colors focus:border-carbon focus:outline-none @error('company') border-red-500 @enderror"
                        >
                            <option value="" disabled {{ old('company', $selected) ? '' : 'selected' }}>Selecciona una empresa</option>
                            @foreach ($companies as $slug => $company)
                                <option value="{{ $slug }}" {{ old('company', $selected) === $slug ? 'selected' : '' }}>
                                    {{ $company['label'] }}
                                </option>
                            @endforeach
                        </select>
                        @error('company') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                        <div class="flex flex-col gap-2">
                            <label for="phone" class="text-sm font-semibold text-carbon">Teléfono</label>
                            <input
                                type="tel" id="phone" name="phone" required maxlength="30"
                                value="{{ old('phone') }}"
                                class="rounded-xl border border-gray-300 px-4 py-3 text-sm text-carbon transition-colors focus:border-carbon focus:outline-none @error('phone') border-red-500 @enderror"
                                placeholder="442 000 0000"
                            >
                            @error('phone') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="email" class="text-sm font-semibold text-carbon">Correo electrónico</label>
                            <input
                                type="email" id="email" name="email" required maxlength="150"
                                value="{{ old('email') }}"
                                class="rounded-xl border border-gray-300 px-4 py-3 text-sm text-carbon transition-colors focus:border-carbon focus:outline-none @error('email') border-red-500 @enderror"
                                placeholder="tu@correo.com"
                            >
                            @error('email') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="message" class="text-sm font-semibold text-carbon">Mensaje</label>
                        <textarea
                            id="message" name="message" required maxlength="3000" rows="5"
                            class="resize-none rounded-xl border border-gray-300 px-4 py-3 text-sm text-carbon transition-colors focus:border-carbon focus:outline-none @error('message') border-red-500 @enderror"
                            placeholder="Cuéntanos qué necesitas"
                        >{{ old('message') }}</textarea>
                        @error('message') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <x-ui.button type="submit" class="w-full justify-center sm:w-fit">
                        Enviar mensaje
                    </x-ui.button>
                </form>
            </div>

            <div data-reveal class="flex flex-col gap-4">
                <span class="text-xs font-semibold uppercase tracking-[0.2em] text-gray-400">
                    O contáctanos directamente
                </span>

                @foreach ($sidebarCards as $slug => $meta)
                    @php $company = $companies[$slug] ?? null; @endphp
                    @continue(! $company)

                    <button
                        type="button"
                        data-contact-shortcut="{{ $slug }}"
                        class="group flex items-center gap-4 rounded-2xl border border-gray-200 p-5 text-left transition-colors hover:border-[var(--shortcut-accent)]"
                        style="--shortcut-accent: {{ $meta['accent'] ? "var(--color-{$meta['accent']})" : 'var(--color-carbon)' }}"
                    >
                        <span
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl text-white"
                            style="background: var(--shortcut-accent)"
                        >
                            <x-ui.icon :name="$meta['icon']" class="h-5 w-5" />
                        </span>
                        <span class="flex flex-col">
                            <span class="text-sm font-semibold text-carbon">{{ $company['label'] }}</span>
                            <span class="text-xs text-gray-500">{{ $company['email'] }}</span>
                        </span>
                    </button>
                @endforeach

                <p class="text-xs leading-relaxed text-gray-400">
                    Al elegir una empresa aquí, se preselecciona automáticamente en el formulario.
                </p>
            </div>
        </div>
    </section>
</x-layouts.app>
