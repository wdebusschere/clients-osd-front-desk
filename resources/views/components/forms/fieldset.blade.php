@props(['legend' => ''])

<fieldset {{ $attributes->merge(['class' => 'rounded-lg border border-gray-300 dark:border-slate-600 p-5 w-auto']) }}>
    <legend {{ $legend->attributes->class(['px-3 font-semibold']) }}>{{ $legend }}</legend>

    {{ $slot }}
</fieldset>
