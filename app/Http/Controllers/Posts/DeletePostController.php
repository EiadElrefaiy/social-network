<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class DeletePostController extends Controller
{
    public function delete(Post $post)
    {
        $post->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully',
        ]);
    }
}
