<?php

namespace App\Livewire\Notifications;

use App\Livewire\Notifications\Traits\ManagesNotifications;
use Livewire\Component;

class AsidePanel extends Component
{
    use ManagesNotifications;

    public bool $showingAsidePanel = false;

    protected $listeners = [
        'notification-updated' => '$refresh',
        'notification-deleted' => '$refresh',
    ];

    public function render()
    {
        $notifications = auth()->user()
            ->notifications()
            ->unread()
            ->latest()
            ->get();

        return view('livewire.notifications.aside-panel')
            ->with([
                'notifications' => $notifications
            ]);
    }
}
