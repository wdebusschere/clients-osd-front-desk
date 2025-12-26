<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Notifications\DatabaseNotification;

class DatabaseNotificationPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, DatabaseNotification $notification): bool
    {
        return $user->notifications()->get()->contains($notification);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, DatabaseNotification $notification): bool
    {
        return $user->notifications()->get()->contains($notification);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, DatabaseNotification $notification): bool
    {
        return $user->notifications()->get()->contains($notification);
    }
}
