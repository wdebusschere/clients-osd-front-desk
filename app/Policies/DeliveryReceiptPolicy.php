<?php

namespace App\Policies;

use App\Models\DeliveryReceipt;
use App\Models\User;

class DeliveryReceiptPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('delivery receipts:view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, DeliveryReceipt $deliveryReceipt): bool
    {
        return $user->can('delivery receipts:view');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('delivery receipts:create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, DeliveryReceipt $deliveryReceipt): bool
    {
        return $user->can('delivery receipts:update');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  DeliveryReceipt  $deliveryReceipt
     * @return bool
     */
    public function delete(User $user, DeliveryReceipt $deliveryReceipt): bool
    {
        return $user->can('delivery receipts:delete');
    }

    public function deliverToUser(User $user, DeliveryReceipt $deliveryReceipt): bool
    {
        return (int) $user->id === (int) $deliveryReceipt->user_id;
    }
}
