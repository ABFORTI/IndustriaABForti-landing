<x-layouts.app
    title="Logística — Almacenaje, transporte y distribución en México | Grupo"
    :description="$division['tagline']"
>
    <x-sections.division-intro :division="$division" />

    <x-sections.capabilities
        eyebrow="Capacidades"
        title="Logística integral, de punta a punta"
        :items="$division['capabilities']"
        :accent="$division['accent']"
    />

    <x-sections.infrastructure-stats
        :sites="config('infrastructure')"
        :accent="$division['accent']"
    />

    <x-sections.cta-strip :accent="$division['accent']" />

    <x-seo.local-business-schema
        :division="$division"
        :area-served="array_column(config('infrastructure'), 'city')"
    />
</x-layouts.app>
