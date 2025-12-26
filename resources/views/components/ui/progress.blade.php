@props([
    'value' => 0,
    'indeterminate' => false,
])

<div {{ $attributes->merge(['class' => 'w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700 overflow-hidden']) }}>
    <div class="bg-gray-900 dark:bg-slate-100 h-full @if($indeterminate) animate-bounce-horizontal @endif" style="width: {{ $indeterminate ?: $value }}%"
    ></div>
</div>
