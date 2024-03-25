<?php

namespace App\Http\Controllers\Api\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class GetPostsController extends Controller
{
    public function homeFeed()
    {
        $user = Auth::user();
        $friends = $user->friends->pluck('id')->push($user->id);
        $homeFeedPosts = Post::with(['user', 'likes.user', 'comments.user'])->whereIn('user_id', $friends)->orderBy('created_at', 'desc')->get();

        return response()->json(['homeFeedPosts' => $homeFeedPosts]);
    }

    public function userPosts()
    {
        $user = Auth::user();

        $userPosts = Post::with(['user', 'likes.user', 'comments.user'])->where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        return response()->json(['userPosts' => $userPosts]);
    }
}
