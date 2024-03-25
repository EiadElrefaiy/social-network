<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class SearchUserController extends Controller
{
    public function search(Request $request)
    {
        $users = User::where("name", "like", '%' . $request->value . '%')->get();
        
        $users = count($users) > 0 ? $users : User::get();

        return response()->json(['users' => $users]);
    }
}
