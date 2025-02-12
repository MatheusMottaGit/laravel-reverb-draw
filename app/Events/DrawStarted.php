<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DrawStarted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $winner;

    public function __construct(string $winner)
    {
        $this->winner = $winner;
    }

    public function broadcastOn()
    {
        return new Channel('draw');
    }

    public function broadcastWith() {
        return [
            'winner' => $this->winner
        ];
    }
}
