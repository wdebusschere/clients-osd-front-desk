<?php

namespace App\Livewire\Locations;

use App\Models\Location;
use App\Traits\Livewire\TableFeatures;
use Livewire\Attributes\Url;
use Livewire\Component;

class Table extends Component
{
    use TableFeatures;

    #[Url]
    public ?int $responsibleId = null;

    public function updated()
    {
        $this->resetPage();
    }

    public function render()
    {
        $locations = Location::with([
            'responsible:id,name',
        ])
            ->search($this->search)
            ->when($this->responsibleId, fn($query) => $query->where('responsible_id', $this->responsibleId));

        foreach ($this->order as $attribute => $direction) {
            $locations->orderBy($attribute, $direction);
        }

        return view(
            'livewire.locations.table',
            [
                'locations' => $locations->paginate($this->perPage)
            ]
        );
    }
}
