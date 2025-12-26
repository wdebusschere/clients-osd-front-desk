<?php

namespace App\Policies;

use App\Models\RecipientType;
use App\Models\User;

class RecipientTypePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('recipient types:view');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('recipient types:create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, RecipientType $recipientType): bool
    {
        return $user->can('recipient types:update');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  RecipientType  $recipientType
     * @return bool
     */
    public function delete(User $user, RecipientType $recipientType): bool
    {
        return $user->can('recipient types:delete');
    }
}
