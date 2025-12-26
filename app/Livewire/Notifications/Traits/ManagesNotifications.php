<?php

namespace App\Livewire\Notifications\Traits;

use Illuminate\Notifications\DatabaseNotification;

trait ManagesNotifications
{
    public function goToMessage(DatabaseNotification $notification)
    {
        if ($notification->unread()) {
            $notification->markAsRead();
        }

        return $this->redirect($notification->data['url']);
    }

    public function toggleRead(DatabaseNotification $notification)
    {
        $this->authorize('update', $notification);

        $notification->unread() ? $notification->markAsRead() : $notification->markAsUnread();

        $this->dispatch('notification-updated');
    }

    public function delete(DatabaseNotification $notification)
    {
        $this->authorize('delete', $notification);

        $notification->delete();

        $this->dispatch('notification-deleted');
    }
}
