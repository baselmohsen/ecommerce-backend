<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SettingController extends Controller
{
    
    public function index()
    {

            Gate::authorize('settings.index');

        // $setting = Setting::first(); 
        // return view('admin.settings.index', compact('setting'));
         return view('admin.settings.index');
    }

    
    public function update(Request $request)
    {

         Gate::authorize('settings.update');

        $request->validate([
            'pharmacy_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

       
        $setting = Setting::first() ?? new Setting();

     
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('settings', 'public');
            $setting->logo = $logoPath;
        }

        // باقي البيانات
        $setting->pharmacy_name = $request->pharmacy_name;
        $setting->phone = $request->phone;
        $setting->email = $request->email;
        $setting->address = $request->address;
        $setting->facebook = $request->facebook;
        $setting->instagram = $request->instagram;

        $setting->save();

        
        cache()->forget('settings');

        return back()->with('success', 'Settings updated successfully');
    }
}