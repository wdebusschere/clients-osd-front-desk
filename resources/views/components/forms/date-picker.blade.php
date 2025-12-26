@props([
    'disabled' => false,
    'multiple' => false
])
<input {{ $disabled ? 'disabled' : '' }}
       {{ $multiple ? 'multiple' : '' }}
       {{ $attributes->merge(['class' => 'border border-gray-300 dark:border-slate-700 dark:bg-gray-800 dark:text-slate-300 focus:border-gray-600 dark:focus:border-slate-400 focus:ring-transparent dark:focus:ring-transparent rounded-md shadow-xs disabled:opacity-50 disabled:bg-gray-200']) }}
       data-toggle="datepicker"
       autocomplete="off">
