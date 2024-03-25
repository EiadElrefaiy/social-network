<?php

namespace App\Http\Controllers\Friendship;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Friendship;

class AcceptRequestController extends Controller
{
    public function accept(Request $request)
    {
        $friendship = Friendship::find($request->id);
        $friendship->update([
            'status' => 'accepted',
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Friendship request accepted successfully.',
            'friendship' => $friendship,
        ]);
    }
}
