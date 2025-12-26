<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    <x-section-title>
        <x-slot:title>{{ $title }}</x-slot:title>
        <x-slot:description>{{ $description }}</x-slot:description>
    </x-section-title>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="px-4 py-5 sm:p-6 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
            {{ $content }}
        </div>
    </div>
</div>
