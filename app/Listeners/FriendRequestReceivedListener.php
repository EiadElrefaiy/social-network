<?php

namespace App\Listeners;

use App\Events\FriendRequestReceived;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\FriendRequestNotification;

class FriendRequestReceivedListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  FriendRequestReceived  $event
     * @return void
     */
    public function handle(FriendRequestReceived $event)
    {
        $friendship = $event->friendship;

        // Send a notification to the user who received the friend request
        // You can customize the notification content and channel as needed
        $friendship->user->notify(new FriendRequestNotification($friendship));
    }
}
