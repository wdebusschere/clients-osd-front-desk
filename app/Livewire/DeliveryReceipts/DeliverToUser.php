<?php

namespace App\Livewire\DeliveryReceipts;

use App\Models\DeliveryReceipt;
use App\Notifications\DeliveryReceipts\DeliveryNotification;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Validate;
use Livewire\Component;

class DeliverToUser extends Component
{
    public DeliveryReceipt $deliveryReceipt;

    #[Validate('nullable|exists:users,id')]
    public ?int $recipient_id = null;

    public function save()
    {
        Gate::authorize('deliverToUser', $this->deliveryReceipt);

        $deliveryNote = $this->deliveryReceipt->deliveryNotes()->create([
            'user_id' => $this->recipient_id
        ]);

        $deliveryNote->user->notify(new DeliveryNotification($this->deliveryReceipt));

        $this->reset('recipient_id');

        $this->dispatch('delivery-note-created');
    }
}
