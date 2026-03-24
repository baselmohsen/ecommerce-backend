<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue; 
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderDoneNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Order Update #' . $this->order->id)
                    ->greeting('Hello ' . $notifiable->name )
                    ->line('Your order status has been updated.')
                    ->line('Order ID: #' . $this->order->id)
                    ->line('New Status: ' . ucfirst($this->order->status))
                    ->action('View Orders', url('/profile'))
                    ->line('Thank you for shopping with us!')
                    ->salutation('Regards, sara pharmacy');
    }
}