@props([
    'heading',
    'content'
])
<div {{ $attributes->merge(['class' => 'rounded-lg border border-gray-200 dark:border-slate-800 overflow-hidden']) }} x-data="{ filtersCollapsed: true }">
    <div {{ $heading->attributes->merge(['class' => 'font-bold bg-gray-50 dark:bg-slate-600 cursor-pointer p-4']) }} @click="filtersCollapsed = !filtersCollapsed">
        {{ $heading }}
    </div>

    <div {{ $content->attributes->merge(['class' => 'bg-white dark:bg-slate-700 border-t border-gray-200 dark:border-slate-800 p-4']) }} x-show="!filtersCollapsed" x-collapse>
        {{ $content }}
    </div>
</div>
