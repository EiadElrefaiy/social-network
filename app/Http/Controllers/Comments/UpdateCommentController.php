<?php

namespace App\Http\Controllers\Comments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment; 

class UpdateCommentController extends Controller
{
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'text' => 'required',
        ]);
        
        $comment->update([
            'text' => $request->input('text'),
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'Comment updated successfully',
            'comment' => $comment,
        ]);
    }
}
