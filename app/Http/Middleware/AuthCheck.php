<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthCheck
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            // Flash message
            $request->session()->flash('auth_message', 'You must be signed in to perform this action!');
            
            // Redirect back safely
            return redirect()->back();
        }

        return $next($request);
    }
}