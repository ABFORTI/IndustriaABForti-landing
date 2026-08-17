<section id="hero" class="overflow-hidden pb-20 pt-16 sm:pb-32 sm:pt-20">
    <div class="container-grid grid grid-cols-1 items-center gap-16 lg:grid-cols-[2fr_3fr] lg:gap-10">
        <div class="flex flex-col gap-8">
            <span data-reveal-onload style="--reveal-delay: 0ms" class="text-xs font-semibold uppercase tracking-[0.2em] text-gray-500">
                Un grupo &middot; Tres empresas &middot; Una sola operación
            </span>

            <h1
                data-reveal-onload
                style="--reveal-delay: 80ms"
                class="font-display text-4xl font-bold leading-[1.08] tracking-tight text-carbon sm:text-5xl lg:text-[3.4rem]"
            >
                Conectamos industria, logística e infraestructura para hacer crecer tu negocio.
            </h1>

            <p data-reveal-onload style="--reveal-delay: 160ms" class="max-w-lg text-base leading-relaxed text-gray-600 sm:text-lg">
                Innovet, Upper Logistics y Control Up Logistics bajo un mismo
                grupo para que tu proyecto no dependa de coordinar proveedores distintos: diseñamos, fabricamos,
                almacenamos, transportamos y desarrollamos infraestructura de punta a punta.
            </p>

            <div data-reveal-onload style="--reveal-delay: 240ms" class="flex flex-wrap gap-4">
                <x-ui.button href="#divisiones" variant="secondary">
                    Conoce nuestras soluciones
                </x-ui.button>
                <x-ui.button :href="route('contact.show')">
                    Hablemos de tu proyecto
                </x-ui.button>
            </div>
        </div>

        <div data-parallax class="flex flex-col gap-4">
            <div class="-mx-4 rounded-2xl border border-gray-100 bg-gray-50/60 p-2 shadow-[0_20px_60px_-30px_rgba(23,24,28,0.25)] sm:mx-0 sm:rounded-3xl sm:p-6">
              <div class="relative aspect-[4/3] w-full overflow-hidden rounded-xl sm:aspect-video sm:rounded-2xl">
                <video
                  id="hero-video"
                  autoplay
                  muted
                  playsinline
                  data-video-a="{{ asset('videos/upper.mp4') }}"
                  data-video-b="{{ asset('videos/innovet.mp4') }}"
                  class="absolute inset-0 h-full w-full object-cover"
                >
                  <source src="{{ asset('videos/upper.mp4') }}" type="video/mp4">
                </video>
              </div>
            </div>
        </div>
    </div>
</section>
