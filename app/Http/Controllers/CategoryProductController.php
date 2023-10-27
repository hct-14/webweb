<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CategoryProductController extends Controller
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

    public function addCategoryProduct()
    {
        $this->AuthLogin();
        $categories = DB::table('tblcategory')->orderBy('category_id', 'desc')->get();
        return view('admin.add_category_product', ['categories' => $categories]);
    }

    public function allCategoryProduct()
    {
        $this->AuthLogin();
        $categories = DB::table('tblcategory')->orderBy('category_id', 'desc')->get();
        $products = DB::table('tblproduct')->get();
        return view('admin.all_category_product', ['categories' => $categories, 'products' => $products]);
    }
    


    public function save_category_product(Request $request)
    {
        $this->AuthLogin(); // Giả sử đây là phương thức xác thực tùy chỉnh.
    
        $data = [
            'product_title' => $request->input('product_title'),
            'product_description' => $request->input('product_description'), // Sửa tên trường này thành 'product_description'.
            'product_author' => $request->input('product_author'), // Sửa tên trường này thành 'product_author'.
            'product_price' => $request->input('product_price'),
            'product_brand' => $request->input('product_brand'),    
            'category_id' => $request->input('product_brand'),
            'product_quantity' => $request->input('product_quantity'),

        ];
        $image = $request->file('product_image'); // Sửa tên trường file thành 'product_image'.

    if ($image) {
        $get_name_image = $image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . rand(0, 99) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/product'), $new_image);
        $data['product_image'] = $new_image;
    } else {
        $data['product_image'] = '';
    }

        DB::table('tblproduct')->insert($data); // Giả sử 'tblproduct' là tên bảng đúng.
        Session::put('message', 'Thêm thành công');
        return redirect()->to('add-category-product'); // Sửa phương thức 'redirect()' thành 'redirect()->to()'.
    }
    
   
    
    
    public function active_category_product($product_id)
    {
        $this->AuthLogin();

        DB::table('tblproduct')
            ->where('product_id', $product_id)
            ->update(['product_status' => 0]);
        Session::put('message', 'Kích hoạt sản phẩm thành công');
        return Redirect::to('all-category-product');
    }

    public function editCategoryProduct($ProductId)
    {
        $this->AuthLogin();
        $categories = DB::table('tblcategory')->orderBy('category_id', 'desc')->get();
        $editCategoryProduct = DB::table('tblproduct')->get();
        return view('admin.edit_category_product', ['categories' => $categories, 'editCategoryProduct' => $editCategoryProduct]);
    
    }

public function update_category_product(Request $request, $product_id)
{
    $this->AuthLogin();

    $data = [
        'product_title' => $request->input('product_title'),
        'product_description' => $request->input('product_desc'),
        'product_author' => $request->input('product_status'),
        'product_price' => $request->input('product_price'),
        'product_quantity' => $request->input('product_quantity'),
    ];

    $image = $request->file('product_image');
    if ($image) {
        $get_name_image = $image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . rand(0, 99) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/product'), $new_image);
        $data['product_image'] = $new_image;
    } else {
        $data['product_image'] = '';
    }
    DB::table('tblproduct')
        ->where('product_id', $product_id)
        ->update($data);

    Session::flash('message', 'Cập nhật thành công');

    return Redirect::to('all-category-product');
}


    public function deleteCategoryProduct($product_id)
    {
        $this->AuthLogin();

        DB::table('tblproduct')
            ->where('product_id', $product_id)
            ->delete();
        Session::flash('message', 'Xóa sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
}
