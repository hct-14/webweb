<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; // Import the Session facade

class SendUserData
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and if user_id is available
        if (auth()->check()) {
            $user_id = auth()->user()->user_id; // Adjust this based on your user model
            Session::put('user_id', $user_id);
        }

        return $next($request);
    }
}
