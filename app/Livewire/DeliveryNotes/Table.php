<?php

namespace App\Livewire\DeliveryNotes;

use App\Models\DeliveryNote;
use App\Traits\Livewire\TableFeatures;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Table extends Component
{
    use TableFeatures;

    #[Locked]
    public ?int $deliveryReceiptId = null;

    protected $listeners = [
        'delivery-note-created' => '$refresh',
    ];

    public function mount()
    {
        $this->order = ['created_at' => 'DESC'];
    }

    public function updated()
    {
        $this->resetPage();
    }

    public function render()
    {
        $deliveryNotes = DeliveryNote::with([
            'user:id,name',
        ])
            ->when($this->deliveryReceiptId, fn($query) => $query->where('delivery_receipt_id', $this->deliveryReceiptId));

        foreach ($this->order as $attribute => $direction) {
            $deliveryNotes->orderBy($attribute, $direction);
        }

        return view(
            'livewire.delivery-notes.table',
            [
                'deliveryNotes' => $deliveryNotes->paginate($this->perPage)
            ]
        );
    }
}
