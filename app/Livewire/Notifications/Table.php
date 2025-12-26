<?php

namespace App\Livewire\Notifications;

use App\Livewire\Notifications\Traits\ManagesNotifications;
use App\Traits\Livewire\TableFeatures;
use Livewire\Component;

class Table extends Component
{
    use ManagesNotifications;
    use TableFeatures;

    public function render()
    {
        $notifications = auth()->user()->notifications()->paginate($this->perPage);

        return view('livewire.notifications.table')
            ->with([
                'notifications' => $notifications
            ]);
    }
}
