<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\San_pham;
use App\Models\Khach_hang;
use App\Models\Gio_hang;
use App\Models\Nganh_hang;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function giohang(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
    
        if (!$productId || $quantity <= 0) {
            return redirect()->back()->with('error', 'Sản phẩm hoặc số lượng không hợp lệ');
        }
    
        $product = San_pham::find($productId);
    
        if (!$product) {
            return abort(404);
        }
    
        $cart = session()->get('cart', []); // Lấy giỏ hàng từ session
    
        if (isset($cart[$productId])) {
            // Nếu sản phẩm đã tồn tại trong giỏ hàng, cộng thêm số lượng
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'product_id' => $productId,
                'name' => $product->product_title,
                'product_price' => $product->product_price,
                'quantity' => $quantity,
                'image' => $product->product_image,
                'id' => $product->product_id,
                'mota' => $product->product_description,
                // Thêm các thông tin khác mà bạn muốn lưu ở đây
            ];
        }
    
        session()->put('cart', $cart); // Lưu giỏ hàng với thông tin sản phẩm chi tiết
        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng thành công');
    }

    public function CheckLogin(Request $request, $productId) {
        // Kiểm tra xem người dùng đã đăng nhập chưa, nếu chưa thì chuyển họ đến trang đăng nhập
        if (!auth()->check()) {
            return redirect()->route('login')->with('message', 'Vui lòng đăng nhập trước khi thêm sản phẩm vào giỏ hàng.');
        }

        // Tiếp theo, bạn có thể thêm sản phẩm vào giỏ hàng tại đây bằng mã logic của bạn
        // Sử dụng $productId để tìm sản phẩm trong cơ sở dữ liệu, sau đó thêm vào giỏ hàng

        // Sau khi thêm sản phẩm vào giỏ hàng, bạn có thể redirect người dùng đến trang giỏ hàng hoặc trang sản phẩm

        // Ví dụ:
        return redirect()->route('cart')->with('message', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }

    public function xemgiohang()
    {
        $categories = DB::table('tblcategory')->orderBy('category_id', 'desc')->get();

        $sanpham = San_pham::all();
        $cart = session()->get('cart', []);

        return view('category.cart', compact('sanpham', 'cart','categories'));
    }

    public function xoasanpham(Request $request, $id)
    {
        // $id should be the product id you want to delete
    
        if (!$id) {
            return redirect()->back()->with('error', 'Sản phẩm không hợp lệ');
        }
    
        $cart = session()->get('cart', []);
    
        if (isset($cart[$id])) {
            // Xóa sản phẩm khỏi giỏ hàng bằng cách unset nó khỏi mảng
            unset($cart[$id]);
            session()->put('cart', $cart); // Cập nhật lại giỏ hàng
        }
    
        return redirect()->back()->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng');
    }

}
