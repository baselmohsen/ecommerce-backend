<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
        public function profile()
    {
                $user = auth()->user();

                $profile=$user->profile;
            
                $orders = $user->orders()->active()->with('items')->latest()->limit(3)->get();

                return view('front.profile.index', compact('profile', 'orders'));
    }

public function updateProfile(Request $request)
{
    $user = auth()->user();

    $data = $request->validate([
        'first_name' => 'nullable|string|max:255',
        'last_name'  => 'nullable|string|max:255',
        'address'    => 'nullable|string|max:255',
        'city'       => 'nullable|string|max:255',
        'phone'      => 'nullable|string|max:50',
        'bio'        => 'nullable|string',
        'image'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'social'     => 'nullable|array',
    ]);

    // Handle image upload
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('profiles', 'public');
        $data['image'] = $path;
    }

    // Insert or update
    $profile = Profile::updateOrCreate(
        ['user_id' => $user->id],
        $data
    );

    return redirect()->back()->with('success', 'Profile saved successfully!');
}
}