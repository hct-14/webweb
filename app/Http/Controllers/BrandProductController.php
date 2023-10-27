<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class BrandProductController extends Controller
{
    public function add_Brand_Product()
    {
        return view('admin.add_brand_product');
    }
    public function allbrandProduct()
    {
        $all_brand_product = DB::table('tblcategory')->get();
        return view('admin.all_brand_product', ['all_brand_product' => $all_brand_product]);
    }

    public function save_brand_product(Request $request)
    {
        $data = [
            // 'category_id' => $request->input('category_id'),
            'category_desc' => $request->input('category_desc'),
            // 'category_status' => $request->input('category_status'),

        ];
        DB::table('tblcategory')->insert($data);
        Session::put('message', 'Thêm thành công');
        return Redirect::to('add-brand-product');
    }
    public function unactive_brand_product($brand_product_id)
    {
        DB::table('tblcategory')
            ->where('category_id', $brand_product_id)
            ->update(['brand_status' =>1]); // Chuyển brand_status thành 0 để không kích hoạt sản phẩm
        Session::put('message', ' kích hoạt sản phẩm');
        return Redirect::to('all-brand-product');
    }
    
    public function active_brand_product($brand_product_id)
    {
        DB::table('tblcategory')
            ->where('category_id', $brand_product_id)
            ->update(['brand_status' => 0]); // Chuyển brand_status thành 1 để kích hoạt sản phẩm
        Session::put('message', 'Kích hoạt sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
    
    public function editbrandProduct($brandProductId) {
        $editbrandProduct = DB::table('tblcategory')
            ->where('category_id', $brandProductId)
            ->get(); // Sử dụng first() để lấy một bản ghi duy nhất
    
        return view('admin.edit_brand_product', compact('editbrandProduct'));
    }
    public function update_brand_product(Request $request, $brand_product_id){
        $data = [
            'category_name' => $request->input('brand_product_name'),

        ];
        
        DB::table('tblcategory')
            ->where('category_id', $brand_product_id)
            ->update($data);
        
        Session::flash('message', 'Cập nhật thành công');
        
        return Redirect::to('all-brand-product');
    }
    
    public function deletebrandProduct($brand_product_id){
        DB::table('tblcategory')
            ->where('category_id', $brand_product_id)
            ->delete();
        Session::flash('message', 'Xóa sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
    
}
