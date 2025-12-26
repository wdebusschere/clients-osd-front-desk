@props([
    'text',
])
<div {{ $attributes->merge(['class' => 'wrap-break-word text-sm text-gray-400 dark:text-white-500 mt-1']) }}>{{ $text ?? $slot }}</div>
