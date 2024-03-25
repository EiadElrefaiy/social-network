<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class UpdatePostController extends Controller
{
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'text' => 'required',
            'image' => ['nullable' , 'image' ,'mimes:jpeg,png,jpg'],
        ]);
    
        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('public/images/posts', $fileName);
    
            if ($post->image) {
                Storage::delete('public/images/posts/' . $post->image);
            }
    
            $post->update([
                'text' => $request->input('text'),
                'image' => $fileName,
            ]);
        } else {

            $post->update([
                'text' => $request->input('text'),
            ]);
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Post updated successfully',
            'post' => $post->fresh(),
        ], 200);
    }
}
