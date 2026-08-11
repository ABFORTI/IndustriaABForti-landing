<x-layouts.app
    title="Logística — Red logística UpperLogistics y Control Up Logistics en México | Grupo"
    :description="$division['tagline']"
>
    <x-logistica.hero :division="$division" />

    <x-logistica.companies
        :companies="config('logistics.companies')"
        :work-centers="config('logistics.work_centers')"
        :locations="collect(config('locations'))->keyBy('slug')"
    />

    <x-logistica.network-map :division="$division" />

    <x-logistica.services :services="config('logistics.services')" />

    <x-sections.cta-strip :accent="$division['accent']" />

    <x-seo.local-business-schema
        :division="$division"
        :area-served="array_column(config('infrastructure'), 'city')"
    />
</x-layouts.app>
