<?php

namespace App\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Broadcasting\Channel;

class MessageSent implements ShouldBroadcast
{
    public $message;
    public $chatroomId;

    public function __construct($message, $chatroomId)
    {
        $this->message = $message;
        $this->chatroomId = $chatroomId;
    }

    public function broadcastOn()
    {
        return new Channel('chatroom.' . $this->chatroomId);
    }
}
