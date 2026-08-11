{{--
    Schema.org Organization (BRIEF §20), presente en todas las páginas.

    IMPORTANTE: "name" usa el mismo placeholder "Grupo" que el logo del
    navbar y el copyright del footer (ver PLAN.md, decisión #5 de la Fase 2)
    — reemplazar por el nombre legal/comercial real antes de publicar.
    No se incluyen "logo", "telephone" ni "sameAs": esos datos todavía son
    placeholders visibles ([Teléfono], [Correo], redes sociales con href="#")
    y poner un placeholder entre corchetes en JSON-LD lo indexarían los
    buscadores como dato real, a diferencia de un placeholder visible en el
    HTML que un humano reconoce como tal. Mejor omitirlos que mentirle a un
    crawler.
--}}
<script type="application/ld+json">
{!! json_encode([
    // La clave JSON-LD estándar se escribe duplicando la arroba: Blade
    // compila ese token, sin duplicar, como su propia directiva de
    // contexto (Laravel 11+) aunque esté dentro de una cadena PHP.
    '@@context' => 'https://schema.org',
    '@type' => 'Organization',
    'name' => 'Grupo',
    'url' => url('/'),
    'description' => 'Grupo empresarial mexicano con divisiones de Industria, Logística e Inmobiliaria.',
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
