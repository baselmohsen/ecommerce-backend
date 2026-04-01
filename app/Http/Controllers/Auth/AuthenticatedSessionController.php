<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
      

    public function create(): View
    {
         
         
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

     try {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        // ✅ Email verification check
        if (!$user->hasVerifiedEmail()) {

            return redirect()->route('verification.notice')
                ->with('error', 'Please verify your email first.');
        }
        
        $user_id = Auth::id();
        $cart_id = Cookie::get('cart_id');

        if ($cart_id) {
            DB::table('carts')
                ->where('cart_id', $cart_id)
                ->update(['user_id' => $user_id]);
        }

        if ($user->type === 'super_admin') {
            return redirect()->route('admin.dashboard');
        }
        if ($user->type === 'admin') {
            return redirect()->route('admin.profile');
        }
            } catch (\Exception $e) {
                    return redirect()->back()->with('errorr', 'Invalid credentials.');
                }
        return redirect()->route('home');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
