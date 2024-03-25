<?php

namespace App\Http\Controllers\Friendship;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetUserFriendsController extends Controller
{
    public function getFriends(User $user)
    {
        
        $friends = Friendship::where(function ($query) use ($user) {
                $query->where('user_id', $user->id)->orWhere('friend_id', $user->id);
            })->where('status', 'accepted')->with('friend')->get();

        return response()->json([
            'success' => true,
            'friends' => $friends,
        ]);
    }
}
