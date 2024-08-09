<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdateOrder extends Notification
{
    use Queueable;
    private $status;
    private $id_order;

    /**
     * Create a new notification instance.
     */
    public function __construct($payment_status,$id_order)
    {
        $this->status = $payment_status;
        $this->id_order = $id_order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toDatabase(object $notifiable)
    {
        return[
        'id' => $this->id_order, 
        'title' => ' the order '.$this->id_order.' updated to '.$this->status,
        'user' => 'Delevery',
        ];
    }
}
