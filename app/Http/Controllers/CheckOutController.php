<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\log;
use Illuminate\Support\Facades\Auth;




class CheckOutController extends Controller
{
    public function AuthLogin(){
        $admin_id =Session::get('user_id');
        if($admin_id){
            return Redirect::to('trang chu');
        } else{
            return Redirect::to('user-login-hct')->send();

        }
    }
    
    public function CheckOut(){
        $User = DB::table('tbluser')->orderBy('user_id', 'desc')->get();

        $brand_product = DB::table('tblproduct')->orderBy('product_id', 'desc')->get();
        $categories = DB::table('tblcategory')->orderBy('category_id', 'desc')->get();
        $userId = DB::table('tbluser')->orderBy('user_id', 'desc')->get();
        $cart = session()->get('cart', []); // Lấy dữ liệu giỏ hàng từ session

        return view('category.checkout', compact('brand_product', 'categories', 'userId', 'cart', 'User'));
    }

    public function Save_Checkout(Request $request) {
        // $this->AuthLogin();
        // Lấy user_id từ biểu mẫu
        $UserId = $request->input('UserId');

        // Tạo một mảng dữ liệu từ biểu mẫu
        $data = [
            'user_id' => $UserId,
            'order_receiver' => $request->input('kh_ten'), 
            'order_address' => $request->input('kh_diachi'), 
            'order_value' => $request->input('oder_value'), 

            'oder_email' => $request->input('kh_email'), 
            'order_notes' => $request->input('kh_cmnd'), 
            'order_phone' => $request->input('kh_dienthoai'), 
            'order_payment' => $request->input('httt_ma'),
            'oder_status' => 0, 
        ];
    
        // Chèn dữ liệu vào cơ sở dữ liệu và lấy ID của bản ghi
        $shipping = DB::table('tblorder')->insert($data);
    
        // Lưu ID đơn hàng trong phiên
        Session::put('shipping', $shipping);
        $cart = session()->get('cart', []);
        if (!empty($cart)) {
            foreach ($cart as $productId => $item) {
                unset($cart[$productId]);
            }
            session()->put('cart', $cart);
        }
        // Chuyển hướng người dùng đến trang kiểm tra
        return redirect('/order-finall');
    }
    public function ThongTin(){
        $brand_product = DB::table('tblproduct')->orderBy('product_id', 'desc')->get();
        $categories = DB::table('tblcategory')->orderBy('category_id', 'desc')->get();


    
     return view('category.order_finall', compact('brand_product', 'categories', ));
    }

    public function Deltai_Order(Request $request) {
        // Lấy giá trị UserId từ session
        $userId = $request->session()->get('UserId');
        // Lấy thông tin chi tiết của đơn hàng dựa trên user_id
        $order_detail = DB::table('tblorder')
            ->where('user_id', $userId)
            ->get();
        
        dd($order_detail);
        foreach ($order_detail as $order) {
            DB::table('tblorder_details')->insert([
                'order_id' => $order->order_id,
                'product_id' => $order->product_id ,
                'quantity' => $order->column2,
                'order_code' => $order->column2,
                'purchase_price' => $order->column2,
                'tima_final' => $order->column2,

                // Thêm các cột khác tương ứng từ bảng tblorder vào bảng tblanother
            ]);
        }
        // Tiếp tục xử lý hoặc trả về view tại đây
    }
    
    
    
    
}
