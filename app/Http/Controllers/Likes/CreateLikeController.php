<?php

namespace App\Http\Controllers\Likes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class CreateLikeController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'post_id' => ['required' , 'exists:posts,id'],
        ]);

        $existingLike = auth()->user()->likes()->where('post_id', $request->post_id)->first();

        $likeStatus = "";
        if ($existingLike) {
            $likeStatus = "unlike";
            $existingLike->delete();
            $message = 'Post unliked successfully';
        } else {
            $likeStatus = "like";
            auth()->user()->likes()->create([
                'post_id' => $request->post_id,
            ]);
            $message = 'Post liked successfully';
        }

        $post = Post::findOrFail($request->post_id);

        return response()->json([
            'success' => true,
            'message' => $message,
            'likeCount' => $post->likes->count(),
            'likeStatus' => $likeStatus,
        ]);
    }
}
