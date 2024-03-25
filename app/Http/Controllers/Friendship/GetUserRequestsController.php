<?php

namespace App\Http\Controllers\Friendship;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetUserRequestsController extends Controller
{
    public function getFriendRequests(User $user)
    {
        $friendRequests = Friendship::where('friend_id', $user->id)->where('status', 'pending')->with('user') ->get();

        return response()->json([
            'success' => true,
            'friendRequests' => $friendRequests,
        ]);
    }
}
