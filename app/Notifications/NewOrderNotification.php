<?php
namespace App\Notifications; 
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewOrderNotification extends Notification implements ShouldBroadcast
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
        return ['broadcast'];
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
    // public function toDatabase($notifiable)
    // {
    //         return [
    //             'order_id' => $this->order->id,
    //             'total'    => $this->order->total,
    //             'message'  => 'New order created',
    //             'url'  => url('/admin/orders/' . $this->order->id),
    //         ];
    //     }

   public function toBroadcast($notifiable)
    {
         return new BroadcastMessage([
        'id' => $this->order->id,
        'first_name' => $this->order->first_name,
        'last_name' => $this->order->last_name,
        'total' => $this->order->total,
        'status' => $this->order->status,
        'created_at' => $this->order->created_at->diffForHumans(),
        'view_url' => route('admin.orders.show', $this->order->id),
        'edit_url' => route('admin.orders.edit', $this->order->id),
        'delete_url' => route('admin.orders.destroy', $this->order->id),
    ]);
    }
        
    public function toArray($notifiable)
    {
        return [
          
        ];
    }
}