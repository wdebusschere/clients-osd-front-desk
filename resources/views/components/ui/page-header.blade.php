<header class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
    <h2 class="font-semibold text-2xl leading-tight text-gray-600 dark:text-slate-500">
        {{ $title ?? '' }}
    </h2>

    {{ $slot }}
</header>
