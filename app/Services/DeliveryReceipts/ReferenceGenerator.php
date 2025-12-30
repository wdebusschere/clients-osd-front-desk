<?php

namespace App\Services\DeliveryReceipts;

use App\Models\DeliveryReceipt;
use Illuminate\Support\Str;

class ReferenceGenerator
{
    public function __construct(
        public DeliveryReceipt $deliveryReceipt
    ) {
    }

    public function generate(): string
    {
        $deliveryReceipt = $this->deliveryReceipt;

        $id = $deliveryReceipt->id;
        $recipientType = $deliveryReceipt->recipientType->name;
        $year = $deliveryReceipt->created_at->format('Y');

        $reference = sprintf(
            'DR-%d%05d-%.3s',
            $year,
            $id,
            Str::slug($recipientType),
        );

        return strtoupper($reference);
    }
}
