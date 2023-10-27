<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


// class SessionMiddleware
// {
//     public function handle($request, Closure $next)
//     {
//         if (session()->has('user_id') && session()->has('user_fullname')) {
//             // Session tồn tại, cho phép tiếp tục
//             return $next($request);
//         } else {
//             // Session không tồn tại, chuyển hướng hoặc thực hiện các xử lý tùy ý
//             return redirect('/user-login-hct')->with('message', 'Vui lòng đăng nhập.');
//         }
//     }
// }

