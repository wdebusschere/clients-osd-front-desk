<?php

namespace App\Notifications\DeliveryReceipts;

use App\Models\DeliveryReceipt;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LocationResponsibleNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public DeliveryReceipt $deliveryReceipt,
    ) {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the notification's database type.
     */
    public function databaseType(object $notifiable): string
    {
        return __("New delivery for :location", ['location' => $this->deliveryReceipt->location->name]);
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(__("Receipt of order to the :location location", ['location' => $this->deliveryReceipt->location->name]))
            ->greeting(trans('app.dear').' '.$notifiable->name.',')
            ->line(__("A new order was received for the :location location on :date.", [
                'location' => $this->deliveryReceipt->location->name,
                'date' => $this->deliveryReceipt->created_at->isoFormat('LL')
            ]))
            ->action(trans_choice('app.see_details', 0), route('delivery-receipts.show', $this->deliveryReceipt));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => __("Receipt of order to the :location location", ['location' => $this->deliveryReceipt->location->name]),
            'url' => route('delivery-receipts.show', $this->deliveryReceipt),
        ];
    }
}
