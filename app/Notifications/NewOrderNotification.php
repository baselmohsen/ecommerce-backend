<?php
namespace App\Notifications; 
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewOrderNotification extends Notification
{
    use Queueable;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    // القنوات
    public function via($notifiable)
    {
        return ['database'];
    }

    // Mail
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //         ->subject('New Order')
    //         ->line('New order has been placed.')
    //         ->line('Order ID: ' . $this->order->id)
    //         ->action('View Order', url('/admin/orders/' . $this->order->id))
    //         ->line('Thank you!');
    // }
    public function toDatabase($notifiable)
    {
            return [
                'order_id' => $this->order->id,
                'total'    => $this->order->total,
                'message'  => 'New order created',
                'url'  => url('/admin/orders/' . $this->order->id),
            ];
        }
    // Database
    public function toArray($notifiable)
    {
        return [
          
        ];
    }
}