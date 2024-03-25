<?php

namespace App\Http\Controllers\Api\Friendship;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Friendship;
use App\Events\FriendRequestReceived;

class CreateRequestController extends Controller
{
    public function create(Request $request)
    {
        $user = Auth::user();

        $friendship = Friendship::create([
            'user_id' => $user->id,
            'friend_id' => $request->friend_id,
            'status' => 'pending',
        ]);

        //event(new FriendRequestReceived($friendship));

        return response()->json([
            'success' => true,
            'message' => 'Friendship request sent successfully.',
            'friendship' => $friendship,
        ]);
    }
}