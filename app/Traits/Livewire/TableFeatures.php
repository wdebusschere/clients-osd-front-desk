<?php

namespace App\Traits\Livewire;

use Livewire\Attributes\Url;
use Livewire\WithPagination;

trait TableFeatures
{
    use WithPagination;

    public $perPageOptions = [15, 30, 50, 100];

    public $perPage;

    #[Url]
    public $order = [];

    #[Url(as: 'q')]
    public $search = '';

    /**
     * Boots the trait.
     */
    public function bootTableFeatures()
    {
        $this->perPage = $this->perPageOptions[0];
    }

    /**
     * Listens for the updated search event.
     */
    public function updatedSearch()
    {
        $this->resetPage();
    }

    /**
     * Sorts the collection by a given attribute.
     *
     * @param $attribute
     */
    public function setOrder($attribute)
    {
        $this->resetPage();

        if (isset($this->order[$attribute])) {
            if ($this->order[$attribute] === 'ASC') {
                $this->order[$attribute] = 'DESC';
            } else {
                unset($this->order[$attribute]);
            }

            return;
        }

        $this->order[$attribute] = 'ASC';
    }

    public function resetFilters()
    {
        $this->reset();
        $this->resetPage();
    }
}
