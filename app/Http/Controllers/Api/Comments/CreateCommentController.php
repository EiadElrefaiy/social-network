<?php

namespace App\Http\Controllers\Api\Comments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CreateCommentController extends Controller
{
    public function create(Request $request, Post $post)
    {
        $request->validate([
            'text' => 'required',
        ]);
        
        $comment = Auth::user()->comments()->create([
            'post_id' => $post->id,
            'text' => $request->input('text'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Comment created successfully',
            'comment' => $comment,
            'commentId' => $comment->id,
            'commentsCount' => $post->comments->count(),
        ]);
    }
}
