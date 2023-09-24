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
        $admin_email = $request->admin_emai;
        $admin_password = $request->iadmin_password;
    
        $result = DB::table('btl_admins')
            ->where('admin_email', $admin_email)
            ->where('admin_password', $admin_password)
            ->first();
    
        // Debugging and printing the result
        echo '<pre>';
        print_r($result);
        echo '</pre>';
    }
}
