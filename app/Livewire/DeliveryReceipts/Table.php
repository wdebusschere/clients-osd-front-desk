<?php

namespace App\Livewire\DeliveryReceipts;

use App\Models\DeliveryReceipt;
use App\Traits\Livewire\TableFeatures;
use Livewire\Attributes\Url;
use Livewire\Component;

class Table extends Component
{
    use TableFeatures;

    #[Url]
    public ?int $recipientTypeId = null;

    #[Url]
    public ?int $userId = null;

    public function mount()
    {
        $this->order = ['reference' => 'DESC'];
    }

    public function updated()
    {
        $this->resetPage();
    }

    public function render()
    {
        $deliveryReceipts = DeliveryReceipt::with('recipientType:id,name', 'user:id,name')
            ->search($this->search)
            ->when($this->recipientTypeId, fn($query) => $query->where('recipient_type_id', $this->recipientTypeId))
            ->when($this->userId, fn($query) => $query->where('user_id', $this->userId));

        foreach ($this->order as $attribute => $direction) {
            $deliveryReceipts->orderBy($attribute, $direction);
        }

        return view(
            'livewire.delivery-receipts.table',
            [
                'deliveryReceipts' => $deliveryReceipts->paginate($this->perPage)
            ]
        );
    }
}
