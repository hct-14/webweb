<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class OderController extends Controller
{
    //  public function __contruct(){
    //     $this->order = $order;
    //  } 
    public function OderCheck()
    {
        // Lấy danh sách đơn hàng từ bảng "tblorder"
        $orders = DB::table('tblorder')->orderBy('order_id', 'desc')->get();
    
        return view('admin.all_order', ['orders' => $orders]);
    }
    
    public function unactive($order_id) 
    {
        DB::table('tblorder')
            ->where('order_id', $order_id)
            ->update(['oder_status' => 1]); // Chuyển order_status thành 1 để không kích hoạt đơn hàng
        Session::flash('message', 'Hủy kích hoạt đơn hàng');
        return redirect()->back();
    }
    
    public function active($order_id)
    {
        DB::table('tblorder')
            ->where('order_id', $order_id)
            ->update(['oder_status' => 0]); // Chuyển order_status thành 0 để kích hoạt đơn hàng
        Session::flash('message', 'Kích hoạt đơn hàng thành công');
        return redirect()->back();
    }
    public function CheckHang($userId){
        $orders = DB::table('tblorder')
        ->where('user_id', $userId)
        ->get();

    // So sánh và kiểm tra dữ liệu
    $hasOrders = $orders->count() > 0;

    // Trả về view dựa trên kết quả so sánh
    if ($hasOrders) {
        return view('user.kiemtrahang', ['orders' => $orders]);
    } else {
        // return view('khong-co-don-hang');
    }
    }

    public function SuaThongTin(Request $request) {
        // Lấy dữ liệu từ request
        $order_id = $request->input('order_id');
        $fullname = $request->input('fullname');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $address = $request->input('address');
        $note = $request->input('note');
    
        // Cập nhật thông tin vào bảng tblorder
        DB::table('tblorder')
            ->where('order_id', $order_id)
            ->update([
                'order_receiver' => $fullname,
                'order_phone' => $phone,
                'oder_email' => $email,
                'order_address' => $address,
                'order_notes' => $note,
            ]);
    // dd($order_id);
        return redirect()->back();
    }
    
    public function deleteOrder($order)
    {
        // Add any validation or permission checks here if needed.
    
        DB::table('tblorder')->where('order_id', $order)->delete();
        Session::flash('message', 'Xóa đơn hàng thành công');
        // dd($order);
        return redirect()->back();
    }

    
}

