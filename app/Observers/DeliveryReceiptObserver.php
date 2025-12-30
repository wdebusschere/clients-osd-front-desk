<?php

namespace App\Observers;

use App\Models\DeliveryReceipt;
use App\Services\DeliveryReceipts\LabelGenerator;
use App\Services\DeliveryReceipts\ReferenceGenerator;

class DeliveryReceiptObserver
{
    /**
     * Handle the DeliveryReceipt "created" event.
     */
    public function created(DeliveryReceipt $deliveryReceipt): void
    {
        $referenceGenerator = new ReferenceGenerator($deliveryReceipt);
        $deliveryReceipt->reference = $referenceGenerator->generate();
        $deliveryReceipt->saveQuietly();

        // Generate and store label
        $labelGenerator = new LabelGenerator($deliveryReceipt);
        $labelGenerator->store();
    }

    /**
     * Handle the DeliveryReceipt "updating" event.
     */
    public function updating(DeliveryReceipt $deliveryReceipt): void
    {
        // Generate reference
        $referenceGenerator = new ReferenceGenerator($deliveryReceipt);
        $deliveryReceipt->reference = $referenceGenerator->generate();

        // Generate and store label
        $labelGenerator = new LabelGenerator($deliveryReceipt);
        $labelGenerator->store();
    }
}
