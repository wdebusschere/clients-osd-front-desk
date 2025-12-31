<?php

namespace App\Notifications\DeliveryReceipts;

use App\Models\DeliveryReceipt;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DeliveryNotification extends Notification
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
        return __('New delivery');
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Recebeu uma nova encomenda')
            ->greeting('Caro/a '.$notifiable->name)
            ->line('Recebeu uma encomenda a '.$this->deliveryReceipt->created_at->isoFormat('LL'))
            ->action('Ver detalhes', route('delivery-receipts.show', $this->deliveryReceipt));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Recebeu uma nova encomenda',
            'url' => route('delivery-receipts.show', $this->deliveryReceipt),
        ];
    }
}
