<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $friends = $user->friends->pluck('friend_id')->push($user->id);
        $homeFeedPosts = Post::with(['user', 'likes.user', 'comments.user'])->whereIn('user_id', $friends)->orderBy('created_at', 'desc')->get();
    
        return view('home', compact('homeFeedPosts'));
    }
}
