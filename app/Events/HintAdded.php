<?php

namespace App\Events;

use App\Models\Hint;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class HintAdded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $hint;
    public $userId;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Hint $hint)
    {
        $this->hint = $hint;
        $this->userId = $hint->task->user_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return "hint-added-" . $this->userId;
    }
}
