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

    public function mount()
    {
        $this->fill($this->deliveryReceipt);
    }

    public function save()
    {
        Gate::authorize('update', $this->deliveryReceipt);

        $this->deliveryReceipt->recipient_id = $this->recipient_id;
        $this->deliveryReceipt->save();

        $this->deliveryReceipt->recipient->notify(new DeliveryNotification($this->deliveryReceipt));

        $this->dispatch('saved');
    }
}
