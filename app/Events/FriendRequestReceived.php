<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Friendship;

class FriendRequestReceived implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public $friendship;

    /**
     * Create a new event instance.
     *
     * @param Friendship $friendship
     */
    public function __construct(Friendship $friendship)
    {
        $this->friendship = $friendship;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        // You can customize the channel if needed
        return new Channel('friend-requests');
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'friendship' => $this->friendship,
        ];
    }
}
