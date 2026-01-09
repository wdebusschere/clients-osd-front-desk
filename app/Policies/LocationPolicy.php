<?php

namespace App\Policies;

use App\Models\Location;
use App\Models\User;

class LocationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('locations:view');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('locations:create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Location $location): bool
    {
        return $user->can('locations:update');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  Location  $location
     * @return bool
     */
    public function delete(User $user, Location $location): bool
    {
        return $user->can('locations:delete');
    }
}
