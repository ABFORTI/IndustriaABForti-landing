<x-layouts.app
    title="Industria — Manufactura y soluciones industriales en México | Grupo"
    :description="$division['tagline']"
>
    <x-sections.division-intro :division="$division" />

    <x-sections.capabilities
        eyebrow="Acompañamiento técnico, comunicación y trabajo estrecho con nuestros Clientes"
        title="Descubre nuestros productos de termoformado"
        :items="$division['capabilities']"
        :accent="$division['accent']"
        
    />

    
    <x-sections.industries-served
        :items="$division['industries_served']"
        accent="acent"
        accent-soft="acent-soft"
    />

    <x-sections.cta-strip :accent="$division['accent']" />
</x-layouts.app>
