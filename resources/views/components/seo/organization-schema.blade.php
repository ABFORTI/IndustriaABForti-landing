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
