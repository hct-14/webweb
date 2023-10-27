<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class UserController extends Controller
{
  
    public function userlogout(Request $request)
    {
        // Đảm bảo rằng người dùng đã đăng nhập trước khi đăng xuất.
        if (Auth::check()) {
            Auth::logout(); // Đăng xuất người dùng
            Session::flush(); // Xóa tất cả dữ liệu phiên
        }

        // Chuyển hướng đến trang đăng nhập hoặc trang chính (tùy thuộc vào logic của bạn).
        return Redirect::to('/user-login-hct'); // Thay '/login' bằng đường dẫn mà bạn muốn người dùng được chuyển hướng sau khi đăng xuất.
    }
    
    public function user_login(Request $request)
    {
        if ($request->isMethod("POST")) {
            $user_loginname = $request->input('user_loginname');
            $user_password = $request->input('user_password');
        
            $result = DB::table('tbluser')
                ->where('user_loginname', $user_loginname)
                ->where('user_password', md5($user_password))
                ->first();
            
            if ($result) {
                
                // Set the 'UserId' and 'fullName' session variables
                session(['UserId' => $result->user_id,
                 'fullName' => $result->user_fullname,
                 'address' => $result->user_address,
                 'phone' => $result->user_phone,
                 'email' => $result->user_address,
                 'avt' => $result->user_avt,
                ]);
                // dd($result);
                return redirect('/trang chu');
            } else {
                Session::flash('message', 'Vui lòng nhập thông tin đúng');
                return Redirect::to('/user-login-hct');
            }
        }
        return view('user.login');
    }
    


    // public function index()
    // {
    //     return view('user.login_1');
    // }

    
    public function logout(Request $request)
    {
        // Đảm bảo rằng hàm AuthLogin() đã được định nghĩa ở đây nếu cần thiết.
        // $this->AuthLogin();

        Session::put('user_fullname', null);
        Session::put('user_id', null);
        return Redirect::to('/user');
    }
 
    public function register(Request $request)
    {
        $user_password = md5($request->input('user_password'));
    
        $data = [
            'user_loginname' => $request->input('user_loginname'),
            'user_fullname' => $request->input('user_fullname'),
            'user_email' => $request->input('user_email'),
            'user_password' => $user_password,
            'user_phone' => $request->input('user_phone'),
            'user_address' => $request->input('user_address'),
        ];
    
        $image = $request->file('user_avt');
        
        if ($image) {
            $get_name_image = $image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/avt'), $new_image);
            $data['user_avt'] = $new_image;
        } else {
            $data['user_avt'] = '';
        }
    
        $userlogin_id = DB::table('tbluser')->insertGetId($data);
    
        Session::put('message', 'Đăng Ký thành công');
        Session::put('user_id', $userlogin_id);
        Session::put('user_fullname', $request->input('user_fullname'));

    
        return Redirect::to('/user-login-hct');  
      }

    
    public function index1()
    {
        // $this->AuthLogin();
        $user_by = DB::table('tblproduct')->orderBy('product_id', 'desc')->get();

        return view('user.register', ['user_by' => $user_by,]);
    }
    
    
}
