<?php

namespace App\Http\Controllers\Friendship;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Friendship;

class DeleteFriendController extends Controller
{
    public function delete(Request $request)
    {
        $friendshipId = $request->input('id');

        $friendship = Friendship::find($friendshipId);

        if ($friendship) {
            $friendship->delete();

            return response()->json([
                'success' => true,
                'message' => 'Friendship deleted successfully.',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Friendship not found.',
            ], 404);
        }
    }
}
