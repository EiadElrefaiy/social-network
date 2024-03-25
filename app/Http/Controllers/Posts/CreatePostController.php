<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class CreatePostController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'text' => ['required'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg'],
        ]);
    
        $fileName =null;
    
        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('public/images/posts', $fileName);
        }
    
        $post = auth()->user()->posts()->create([
            'text' => $request->input('text'),
            'image' => $fileName,
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'Post created successfully',
            'post' => $post,
        ], 200);
    }
}
