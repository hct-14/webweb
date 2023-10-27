<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class AuthCheck
{
    public function handle($request, Closure $next)
    {
        if (Session::has('user_id')) {
            return $next($request);
        } else {
            return redirect('/user-login'); // Chuyển hướng về trang đăng nhập nếu chưa đăng nhập
        }
    }
}

