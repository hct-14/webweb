<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class Product_1Controller extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }

    public function addProduct_1()
    {
        $this->AuthLogin();
        $brand_product = DB::table('tblcategory')->get(); // Loại bỏ orderBy
        // $all_product_1 = DB::table('tbl_product_1')->get();
        return view('admin.add_product_1', ['brand_product' => $brand_product,]);
    }
    
    public function allProduct_1()
    {
        $this->AuthLogin();
        $brand_product = DB::table('tblproduct')->orderBy('product_id', 'desc')->get();

        return view('admin.all_product_1', ['brand_product' => $brand_product,]);
    }
    

    public function saveProduct_1(Request $request)
    {
        $this->AuthLogin();

        $data = [
            'product_title' => $request->input('product_title'),
            'product_description' => $request->input('product_desc'),
            'product_theloai' => $request->input('product_theloai'),
            'product_author' => $request->input('product_status'),
            'product_price' => $request->input('product_price'),
            'product_image' => $request->input('product_image'),
            'product_quantity' => $request->input('product_quantity'),
        ];
        $image = $request->file('product_1_image');
        if ($image) {
            $get_name_image = $image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/product1'), $new_image);
            $data['product_1_image'] = $new_image; // Lưu chỉ tên tệp hình ảnh, không cần đường dẫn đầy đủ
        } else {
            $data['product_1_image'] = '';
        }
        DB::table('tbl_product_1')->insert($data);
        Session::put('message', 'Thêm thành công');
        return Redirect::to('add-product-1');
    }

    public function unactiveProduct_1($product_1_id)
    {
        $this->AuthLogin();

        DB::table('tbl_product_1')
            ->where('product_1_id', $product_1_id)
            ->update(['product_1_status' => 1]); // Chuyển product_status thành 0 để không kích hoạt sản phẩm
        Session::put('message', 'Hủy kích hoạt sản phẩm');
        return Redirect::to('all-product-1');
    }

    public function activeProduct_1($product_1_id)
    {
        $this->AuthLogin();

        DB::table('tbl_product_1')
            ->where('product_1_id', $product_1_id)
            ->update(['product_1_status' => 0]); // Chuyển product_status thành 1 để kích hoạt sản phẩm
        Session::put('message', 'Kích hoạt sản phẩm thành công');
        return Redirect::to('all-product-1');
    }

    public function editProduct_1($product_id)
    {
        $editProduct_1 = DB::table('tblproduct')
            ->where('product_id', $product_id)
            ->first();
    
        return view('admin.edit_product_1', compact('editProduct_1'));
    }
    
    public function updateProduct_1(Request $request, $product_1_id)
    {
        $this->AuthLogin();
        $data = [
            'product_title' => $request->input('product_title'),
            'product_description' => $request->input('product_desc'),
            'product_theloai' => $request->input('product_theloai'),
            'product_author' => $request->input('product_status'),
            'product_price' => $request->input('product_price'),
            'product_image' => $request->input('product_image'),
            'product_quantity' => $request->input('product_quantity'),
        ];
        $image = $request->file('product_1_image');
        if ($image) {
            $get_name_image = $image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/product1'), $new_image);
            $data['product_1_image'] = $new_image; // Save only the image file name, not the full path
        }
    
        DB::table('tbl_product_1')
            ->where('product_1_id', $product_1_id)
            ->update($data);
    
        Session::flash('message', 'Cập nhật thành công');

        return Redirect::to('all-product-1');
    }
    

    public function deleteProduct_1($product_1_id)
    {
        $this->AuthLogin();

        DB::table('tbl_product_1')
            ->where('product_1_id', $product_1_id)
            ->delete();
        Session::flash('message', 'Xóa sản phẩm thành công');
        return Redirect::to('all-product-1');
    }
    //end admin
    public function show_category_home($product_id) {
        // Lấy danh sách các danh mục sản phẩm
        $brand_product = DB::table('tblcategory')->orderBy('category_id', 'desc')->get();
    
        // Lấy tất cả sản phẩm của danh mục cụ thể
        $all_category_product = DB::table('tblproduct')
            ->where('category_id', $product_id)
            ->get();
    
        return view('category.show_category_home', [
            'brand_product' => $brand_product,
            'all_category_product' => $all_category_product
        ]);
    }  
        ///end admin


        public function processData(Request $request) {
            $user_id = $request->input('user_id');
            $product_id = $request->input('product_id');
            
            
            $data = [
                'user_id' => $user_id,
                'product_id' => $product_id,
                'comment_content' => $request->input('user_comment'),
            ];
            
            $image = $request->file('comment_images');
            
            if ($image) {
                $get_name_image = $image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 99) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/avt'), $new_image);
                $data['comment_images'] = $new_image;
            } else {
                $data['comment_images'] = '';
            }
            
            // Thêm dữ liệu vào bảng "tblcomment"
            DB::table('tblcomment')->insert($data);
            
            return redirect()->back();
        }
        
            // Tiếp tục thực hiện xử lý khác nếu cần thiết.
        
            // return redirect()->back();
        
        
            public function detail_product($product_id, Request $request) {
                $brand_product = DB::table('tblcategory')->orderBy('category_id', 'desc')->get();
                $categories = DB::table('tblcategory')->orderBy('category_id', 'desc')->get();
                
                // Lấy thông tin chi tiết của sản phẩm dựa trên product_id
                $product_detail = DB::table('tblproduct')
                    ->where('product_id', $product_id)
                    ->get();
                
                $category_ids = []; // Mảng để lưu các category_id
                
                foreach ($product_detail as $detail) {
                    $category_ids[] = $detail->category_id;
                }
                
                // Lấy sản phẩm liên quan bằng cách sử dụng mảng category_ids
                $related_product = DB::table('tblproduct')
                    ->whereIn('category_id', $category_ids)
                    ->get();
                
                $product_id_to_check = $product_id;
                $checkcomment = DB::table('tblcomment')
                    ->join('tbluser', 'tblcomment.user_id', '=', 'tbluser.user_id')
                    ->join('tblproduct', 'tblcomment.product_id', '=', 'tblproduct.product_id')
                    ->where('tblcomment.product_id', $product_id_to_check)
                    ->orderBy('tblcomment.comment_id', 'desc')
                    ->select('tblcomment.*', 'tbluser.user_fullname', 'tblproduct.product_title', 'tbluser.user_avt')
                    ->get();
            
                return view('category.book_page_1', [
                    'brand_product' => $brand_product,
                    'product_detail' => $product_detail,
                    'categories' => $categories,
                    'related_product' => $related_product,
                    'checkcomment' => $checkcomment,
                ]);
            }
               
        public function checkcomment(Request $request){
            $product_id = $request->input('product_id');

            $product_id_to_check = $product_id; // Thay 1 bằng giá trị `product_id` bạn muốn kiểm tra
            $checkcomment = DB::table('tblcomment')
                ->join('tbluser', 'tblcomment.user_id', '=', 'tbluser.user_id')
                ->join('tblproduct', 'tblcomment.product_id', '=', 'tblproduct.product_id')
                ->where('tblcomment.product_id', $product_id_to_check)
                ->orderBy('tblcomment.comment_id', 'desc')
                ->select('tblcomment.*', 'tbluser.user_fullname', 'tblproduct.product_title', 'tbluser.user_avt')
                ->get();
            
        
        dd($checkcomment);
            // return view('ten-view', ['checkcomment' => $checkcomment]);
        }
        
        
     }  
