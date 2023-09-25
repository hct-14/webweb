<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin_login');
    }
    public function show_dashboard(){
        return view('admin.dashboard');

    }
    public function dashboard(Request $request)
    {
        $admin_email = $request->admin_email;
        $admin_password = $request->admin_password;
        
        $result = DB::table('btl_admins')
            ->where('admin_email', $admin_email)
            ->where('admin_password', $admin_password)
            ->first();
        
        // Kiểm tra xem có dữ liệu trả về không
        if ($result) {
            return view('admin.dashboard');
                } else {
            // Dữ liệu không tồn tại
            echo "Không tìm thấy tài khoản với thông tin này.";
        }
    }
}
