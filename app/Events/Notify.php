<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Notify implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $title;
    public $content;
    public $created_at;
    public function __construct($data)
    {
        $this->title = $data['title'];
        $this->content  = $data['content'];
        $this->created_at = $data['created_at'];
    }
    public function broadcastOn()
    {
        return new PrivateChannel('send-notify');
    }
}