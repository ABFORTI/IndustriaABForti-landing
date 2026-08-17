<x-layouts.app
    title="Business AB Forti"
    description="Grupo empresarial mexicano que integra industria y logística."
>
    <x-sections.hero />
    <x-sections.coverage />
    {{-- x-sections.group-brands se retiró: divisions-overview ahora cubre
    las 4 marcas (Innovet, Upper Logistics, Control Up Logistics) 
    con más detalle, evitando dos grids de marcas duplicados
    uno tras otro. El componente group-brands se deja en el repo por si se
    reutiliza en otra página. --}}
    <x-sections.divisions-overview />
    <x-sections.why-us />
    <x-sections.cta-strip size="large" anchor="contacto" accent="logistica" />
</x-layouts.app>
