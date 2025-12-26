@props([
    'label' => null,
    'value' => null,
    'preLine' => false,
])
<div {{ $attributes }}>
    <strong class="block text-gray-600 dark:text-slate-400">{{ $label }}</strong>

    <span class="{{ $preLine === true ? 'whitespace-pre-line' : '' }}">{{ $value ?? $slot }}</span>
</div>
