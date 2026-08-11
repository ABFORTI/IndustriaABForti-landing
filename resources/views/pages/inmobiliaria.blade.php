<x-layouts.app
    title="Inmobiliaria — Proyectos empresariales llave en mano | Grupo"
    :description="$division['subheadline']"
>
    <x-sections.division-intro :division="$division" />

    <x-sections.process-steps
        :steps="$division['process']"
        :accent="$division['accent']"
    />

    <x-sections.project-gallery
        :items="$division['project_placeholders']"
        :accent="$division['accent']"
        :accentSoft="$division['accent_soft']"
    />

    <x-sections.cta-strip :accent="$division['accent']" />
</x-layouts.app>
