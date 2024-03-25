<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ReadUserController extends Controller
{
    public function getProfile($userId)
    {
        $user = User::with(['friends', 'posts', 'friendships'])->find($userId);

        return view('profile', compact('user'));
    }
}
