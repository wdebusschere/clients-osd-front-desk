<?php

namespace App\Livewire\Tables;

use App\Models\Role;
use App\Traits\Livewire\TableFeatures;
use Livewire\Component;

class Roles extends Component
{
    use TableFeatures;

    public function updated()
    {
        $this->resetPage();
    }

    public function render()
    {
        $roles = Role::search($this->search)
            ->withCount('permissions');

        foreach ($this->order as $attribute => $direction) {
            $roles->orderBy($attribute, $direction);
        }

        return view(
            'livewire.tables.roles',
            [
                'roles' => $roles->paginate($this->perPage)
            ]
        );
    }
}
