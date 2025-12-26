@props([
    'value',
    'optional' => false,
])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-600 dark:text-slate-400 mb-1']) }}>
    {{ $value ?? $slot }}
    @if($optional === true)
        <span class="text-muted">- @lang('app.optional')</span>
    @endif
</label>
