<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
class DienDanController extends Controller
{
    public function DiendanIndex(Request $request){
        $user_id = $request->input('user_id');
        // $user_id = 43;

        // $product_id = $request->input('product_id');
        
        
        $data = [
            'user_id' => $user_id,
            'diendan_tittle' => $request->input('bothanhcmt'),

        ];
        $image = $request->file('diendan_img');
            
        if ($image) {
            $get_name_image = $image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = substr($name_image, 0, 100) . '_' . rand(0, 99) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/prodcut1'), $new_image);
            $data['diendan_img'] = $new_image;
        } else {
            $data['diendan_img'] = '';
        }   
        
        
        // Thêm dữ liệu vào bảng "tblcomment"
        DB::table('tbldiendan')->insert($data);
        // dd($data);

        
        return Redirect::to('index-dien-dan');

    }
    public function IndexDien(Request $request){
        $diendan = DB::table('tbldiendan')
        ->join('tbluser', 'tbldiendan.user_id', '=', 'tbluser.user_id')
        ->select('tbldiendan.*', 'tbluser.user_avt', 'tbluser.user_fullname')
        ->orderBy('tbldiendan.diendan_id', 'desc')
        ->get();

        $k1_rediendan = DB::table('rediendan')
        ->join('tbluser', 'rediendan.user_id', '=', 'tbluser.user_id')
        ->join('tbldiendan', 'rediendan.diendan_id', '=', 'tbldiendan.diendan_id')
        ->select('rediendan.*', 'tbldiendan.diendan_tittle', 'tbluser.user_fullname')
        ->get();
    
        return view('user.diendan', ['diendan' => $diendan, 'k1_rediendan' => $k1_rediendan]);
    }
   
public function CheckDienDan(Request $request){
    $diendan_id = $request->input('diendan_id');
    $UserId = $request->input('re_user');


      $data = [
            'diendan_id' => $diendan_id,
            'user_id' => $UserId,

            're_tittle' => $request->input('khachtraloi'),
            // 're_images' => $request->input('re_images'),


        ];
        $image = $request->file('re_images');

        if ($image) {
            $get_name_image = $image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/product1'), $new_image);
            $data['re_images'] = $new_image; // Lưu chỉ tên tệp hình ảnh, không cần đường dẫn đầy đủ
        } else {
            // $data['re_images'] = '';
        }
        // dd($data);  
        DB::table('rediendan')->insert($data);

        // return Redirect::to('index-dien-dan');

        return redirect()->back();
    }
    public function testdd(){
   $k1_rediendan = DB::table('rediendan')
    ->join('tbluser', 'rediendan.user_id', '=', 'tbluser.user_id')
    ->join('tbldiendan', 'rediendan.diendan_id', '=', 'tbldiendan.diendan_id')
    ->whereColumn('rediendan.diendan_id', 'tbldiendan.diendan_id')
    ->select('rediendan.*', 'tbldiendan.diendan_tittle', 'tbluser.user_fullname')
    ->get();

    
    dd($k1_rediendan);
    

    }

}
