<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class HomeController extends Controller
{
    public function index()
    {       
        $categories = DB::table('tblcategory')->orderBy('category_id', 'desc')->get();

        // Lấy tất cả sản phẩm của danh mục cụ thể
        $products = DB::table('tblproduct')
            // ->where('category_id', $product_id)
            ->get();

        return view('pages.home_2', ['categories' => $categories, 'products' => $products]);
    }
    public function layout()
    {       
        $categories = DB::table('tblcategory')->orderBy('category_id', 'desc')->get();

        // Lấy tất cả sản phẩm của danh mục cụ thể
        $products = DB::table('tblproduct')
            // ->where('category_id', $product_id)
            ->get();
        return view('layout2', ['categories' => $categories, 'products' => $products]);
    }
    
    
    public function usercategory()
    {
        return view('category_1');
    }
}

