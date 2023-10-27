<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

class AdminController extends Controller
{

      
    public function AuthLogin(){
        $admin_id =Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        } else{
            return Redirect::to('admin')->send();

        }
    }
    public function index()
    {
        return view('admin_login');
    }
    public function show_dashboard(){
        $this->AuthLogin();
        return view('admin.dashboard');

    }

    public function dashboard(Request $request)
    {
        $admin_email = $request->input('admin_email');
        $admin_password = $request->input('admin_password');

        $result = DB::table('tbladmin')
            ->where('admin_email', $admin_email)
            ->where('admin_password', $admin_password)
            ->first();

        if ($result) {
            Session::put('admin_fullname', $result->admin_fullname);
            Session::put('admin_id', $result->admin_id);
  
            
            return view('admin.dashboard');
        } else {
            Session::flash('message', 'Vui lòng nhập thông tin đúng');
            return Redirect::to('/admin');
        }
    }

    public function logout(Request $request)
    {
        $this->AuthLogin();
        Session::put('admin_fullname', null );
        Session::put('admin_id',null);  
        return Redirect::to('/admin');

    }
    
}
