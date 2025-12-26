<?php

namespace App\Livewire\RecipientTypes;

use App\Models\RecipientType;
use App\Traits\Livewire\TableFeatures;
use Livewire\Component;

class Table extends Component
{
    use TableFeatures;

    public function updated()
    {
        $this->resetPage();
    }

    public function render()
    {
        $recipientTypes = RecipientType::search($this->search);

        foreach ($this->order as $attribute => $direction) {
            $recipientTypes->orderBy($attribute, $direction);
        }

        return view(
            'livewire.recipient-types.table',
            [
                'recipientTypes' => $recipientTypes->paginate($this->perPage)
            ]
        );
    }
}
