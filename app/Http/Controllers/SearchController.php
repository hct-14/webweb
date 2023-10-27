<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class SearchController extends Controller
{
        public function IndexSearch(Request $request){
            $keyword = $request->keyword_submit;
            $brand_product = DB::table('tblproduct')->orderBy('product_id', 'desc')->get();
            $categories = DB::table('tblcategory')->orderBy('category_id', 'desc')->get();

            $seach_item = DB::table('tblproduct')
            ->where('product_title', 'like', '%' . $keyword . '%')
            ->orWhere('product_author', 'like', '%' . $keyword . '%')
            ->get();
        
            return view('pages.search', ['categories' => $categories, 'products' => $brand_product,'seach_item'=>$seach_item] );
        }

}
