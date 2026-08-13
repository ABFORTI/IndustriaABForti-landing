<x-layouts.app
    title="Grupo — Industria, Logística e Inmobiliaria en México"
    description="Grupo empresarial mexicano que integra industria, logística e infraestructura: manufactura, almacenamiento, transporte y desarrollo de proyectos llave en mano."
>
    <x-sections.hero />
    <x-sections.coverage />
    {{-- x-sections.group-brands se retiró: divisions-overview ahora cubre
    las 4 marcas (Innovet, Upper Logistics, Control Up Logistics, AB Forti
    Real Estate) con más detalle, evitando dos grids de marcas duplicados
    uno tras otro. El componente group-brands se deja en el repo por si se
    reutiliza en otra página. --}}
    <x-sections.divisions-overview />
    <x-sections.why-us />
    <x-sections.cta-strip size="large" anchor="contacto" accent="logistica" />
</x-layouts.app>
