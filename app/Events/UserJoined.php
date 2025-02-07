<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserJoined implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $nickname;
    public $participants;

    public function __construct(string $nickname, array $participants)
    {
        $this->nickname = $nickname;
        $this->participants = $participants;
    }

    public function broadcastOn()
    {
        return new Channel('draw'); // PresenceChannel needs authentication
    }
}
