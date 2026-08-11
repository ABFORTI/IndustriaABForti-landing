@props(['division', 'areaServed' => []])

{{--
    Schema.org LocalBusiness "cuando corresponda" (BRIEF §20). Solo se usa en
    la página de Logística: es la única división con datos reales de
    ubicación en el brief (config/infrastructure.php). No se incluye
    "address" (no hay calle/CP reales, solo ciudad) ni "telephone" (sigue
    siendo el placeholder [Teléfono] del footer) — mejor omitir un campo que
    rellenarlo con datos inventados o con texto placeholder que un crawler
    no reconocería como tal.
--}}
<script type="application/ld+json">
{!! json_encode([
    // "@@context": ver nota en components/seo/organization-schema.blade.php.
    '@@context' => 'https://schema.org',
    '@type' => 'LocalBusiness',
    'name' => $division['name'].' — Grupo',
    'url' => route('divisions.show', 'logistica'),
    'parentOrganization' => [
        '@type' => 'Organization',
        'name' => 'Grupo',
    ],
    'areaServed' => array_map(fn ($city) => ['@type' => 'City', 'name' => $city], $areaServed),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
