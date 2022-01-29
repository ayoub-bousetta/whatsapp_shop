<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Orders extends Notification implements  ShouldBroadcast
{
    use Queueable;
    public $userShop;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($shpowner)
    {
        $this->userShop = $shpowner;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'user_id' =>$this->userShop['user_id'],
            'name'=>$this->userShop['name'],
            'slug'=>$this->userShop['slug'],
            'shop_id'=>$this->userShop['shop_id'],
            'order_id'=>$this->userShop['order_id'],
        ];
    }


    public function toBroadcast($notifiable)
        {
            return new BroadcastMessage([   'id' =>$this->userShop['user_id']]);
        }

        public function broadcastType()
        {
            return 'order.craeted';
        }
}
