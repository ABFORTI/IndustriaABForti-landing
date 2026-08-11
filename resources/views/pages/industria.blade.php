<x-layouts.app
    title="Industria — Manufactura y soluciones industriales en México | Grupo"
    :description="$division['tagline']"
>
    <x-sections.division-intro :division="$division" />

    <x-sections.capabilities
        eyebrow="Capacidades"
        title="Manufactura y soluciones a la medida"
        :items="$division['capabilities']"
        :accent="$division['accent']"
    />

    <x-sections.industries-served
        :items="$division['industries_served']"
        :accent="$division['accent']"
    />

    <x-sections.cta-strip :accent="$division['accent']" />
</x-layouts.app>
