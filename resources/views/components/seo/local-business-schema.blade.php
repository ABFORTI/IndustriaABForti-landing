@props(['division', 'areaServed' => []])

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
