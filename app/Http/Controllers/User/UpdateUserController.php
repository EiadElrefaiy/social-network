<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UpdateUserController extends Controller
{
    protected function update(Request $request, $userId)
    {
        $user = User::find($userId);
    
        if (!$user) {
            return response()->json(['status' => false, 'error' => 'User not found'], 404);
        }
    
        $data = $request->all();
    
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($userId)],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'bio' => ['nullable', 'string'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);
    
        if ($validator->fails()) {
            return response()->json(['status' => false, 'error' => $validator->errors()], 422);
        }
    
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->bio = $data['bio'];
    
        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('public/images/users', $fileName);
            $user->image = $fileName;
        }
    
        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }
    
        $user->save();
    
        return redirect()->route('edit.profile')->with('success', 'Profile updated successfully');
    }


    protected function changePass(Request $request, $userId)
    {
        $user = User::find($userId);
    
        if (!$user) {
            return redirect()->route('edit.profile')->with('error', 'User not found');
        }
    
        $data = $request->all();
    
        $validator = Validator::make($data, [
            'old_password' => ['required', 'string'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);
    
        if ($validator->passes()) {
            if (!Hash::check($data['old_password'], $user->password)) {
                $validator->errors()->add('old_password', 'The old password is incorrect.');
                return redirect()->route('edit.profile')->withErrors($validator);
            }
    
            $validator = Validator::make($data, [
                'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            ]);
    
            if ($validator->fails()) {
                return redirect()->route('edit.profile')->withErrors($validator);
            }
    
            $user->update([
                'password' => Hash::make($data['password']),
            ]);
    
            return redirect()->route('edit.profile')->with('success', 'Password updated successfully');
        } else {
            return redirect()->route('edit.profile')->withErrors($validator);
        }
    }
}    