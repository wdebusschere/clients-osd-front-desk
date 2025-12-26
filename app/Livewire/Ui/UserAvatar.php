<?php

namespace App\Livewire\Ui;

use Livewire\Component;

class UserAvatar extends Component
{
    protected $listeners = [
        'refresh-navigation-menu' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.ui.user-avatar');
    }
}
