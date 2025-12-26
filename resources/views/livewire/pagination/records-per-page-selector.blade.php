<x-forms.select wire:model.live="perPage">
    @foreach($this->perPageOptions as $perPageOption)
        <option value="{{ $perPageOption }}" wire:key="dt-per-page-option-key-{{ $perPageOption }}">
            {{ $perPageOption }}
        </option>
    @endforeach
</x-forms.select>
