<?php

namespace App\Http\Controllers\Api\Comments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class DeleteCommentController extends Controller
{
    public function delete(Comment $comment)
    {
        $comment->delete();
        return response()->json([
            'success' => true,
            'message' => 'Comment deleted successfully',
            'commentsCount' => $comment->post->comments->count(),
        ]);
    }
}
