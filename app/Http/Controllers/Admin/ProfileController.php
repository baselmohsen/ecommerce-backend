<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
        public function profile()
    {
        $admin = auth()->user();

        if (!$admin->profile) {
            $admin->profile()->create([]);
        }

        $profile = $admin->profile;

        return view('admin.profile.index', compact('admin', 'profile'));
    }

public function updateProfile(Request $request)
{
    $admin = auth()->user();

    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $admin->id,

        'first_name' => 'nullable|string|max:255',
        'last_name' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:50',
        'address' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:255',
        'bio' => 'nullable|string',
        'social' => 'nullable|string',

        'password' => 'nullable|confirmed|min:6',
        'image' => 'nullable|image',
    ]);

    // update main user table
    $admin->update([
        'name' => $data['name'],
        'email' => $data['email'],
    ]);

    // password
    if (!empty($data['password'])) {
        $admin->update([
            'password' => bcrypt($data['password'])
        ]);
    }

    // handle image
    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('profiles', 'public');
    }

    // convert social JSON
    if (!empty($data['social'])) {
        $data['social'] = json_decode($data['social'], true);
    }

    // update profile
    $admin->profile()->updateOrCreate(
        ['user_id' => $admin->id],
        $data
    );

    return back()->with('success', 'Profile updated successfully');
}
}
