<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AddSale extends Notification
{
    use Queueable;
    private $itemSetKey;
    /**
     * Create a new notification instance.
     */
    public function __construct($itemSetKey)
    {
        $this->itemSetKey = $itemSetKey;
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
        'title' => 'A new sale added',
        'user' => $this->itemSetKey ,
        ];
    }
}
