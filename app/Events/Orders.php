<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Orders implements  ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $afterCommit = true;

    public $userShop;
   

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($shpowner)
    {
        $this->userShop = $shpowner;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        //return new Channel('channel-name');



        return new PrivateChannel('shop.'.$this->userShop->first()->user_id);
    }


    public function broadcastWith()
        {
            return [
                'id' =>$this->userShop->first()->user_id,
                'name'=>$this->userShop->first()->name,
                'slug'=>$this->userShop->first()->slug,
                'shop_id'=>$this->userShop->first()->id,

        
                 ];
        }


    public function broadcastAs()
    {
        return 'order.craeted';
    }



}
