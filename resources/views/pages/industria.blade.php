<x-layouts.app
    title="Industria — Manufactura y soluciones industriales en México | Grupo"
    :description="$division['tagline']"
>
    <x-sections.division-intro :division="$division" :slug="$slug" />

    <x-sections.capabilities
        eyebrow="Acompañamiento técnico, comunicación y trabajo estrecho con nuestros Clientes"
        title="Descubre nuestros productos de termoformado"
        :items="$division['capabilities']"
        :accent="$division['accent']"
        
    />

    <x-sections.industries-served
        :items="$division['industries_served']"
        :accent="$division['accent']"
        :accent-soft="$division['accent_soft']"
    />

    <x-sections.materials
        eyebrow="Materia prima"
        title="Materiales de termoformado con los que trabajamos"
        :items="$division['materials']"
        :accent="$division['accent']"
    />

    <x-sections.cta-strip :accent="$division['accent']" :division="$slug" />
</x-layouts.app>
