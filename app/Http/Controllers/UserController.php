<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
    {
         /** @var User $user */
        $user = Auth::user();
        return view('users.profile', compact('user'));
    }
    
    public function updateProfile(Request $request)
{
    /** @var User $user */
    $user = Auth::user(); // Explicitly type-hint the $user variable
    
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'phone' => 'nullable|string|max:20',
        'avatar' => 'nullable|image|max:1024',
        'current_password' => 'nullable|required_with:password',
        'password' => 'nullable|string|min:8|confirmed',
    ]);
    
    // Check current password if trying to update password
    if ($request->filled('current_password')) {
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }
    }
    
    $user->name = $validated['name'];
    $user->email = $validated['email'];
    $user->phone = $validated['phone'];
    
    if ($request->filled('password')) {
        $user->password = Hash::make($validated['password']);
    }
    
    if ($request->hasFile('avatar')) {
        $avatarPath = $request->file('avatar')->store('avatars', 'public');
        $user->avatar = $avatarPath;
    }
    
    $user->save(); // Intelephense will now recognize this method
    
    return back()->with('success', 'Profile updated successfully.');
}
}