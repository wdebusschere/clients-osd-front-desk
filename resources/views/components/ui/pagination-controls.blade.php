@props(['collection' => null])

<div {{ $attributes->merge(['class' => 'flex justify-between flex-wrap gap-4']) }}>
    <div class="md:flex-1">
        {{ $collection->onEachSide(1)->links() }}
    </div>

    @if($collection->count())
        <div class="flex items-center gap-2 text-sm font-medium text-muted">
            @lang('pagination.per_page')

            @include('livewire.pagination.records-per-page-selector')
        </div>
    @endif
</div>
