<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AddCart implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $amount;
    public function __construct($data)
    {
        $this->amount = $data['amount'];
    }
    public function broadcastOn()
    {
        return new PrivateChannel('addCart');
    }
}
