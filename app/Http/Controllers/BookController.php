<?php
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Book;
 
class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('products', compact('books'));
    }
   
    public function bookCart()
    {
        return view('cart');
    }
    public function addBooktoCart($product_id)
    {
        $book = Book::findOrFail($product_id);
        $cart = session()->get('cart', []);
    
        if (isset($cart[$product_id])) {
            $cart[$product_id]['product_quantity']++; // Cập nhật số lượng sản phẩm
        } else {
            $cart[$product_id] = [
                "product_title" => $book->product_title,
                "product_quantity" => 1,
                "product_price" => $book->product_price,
                "product_image" => $book->product_image
            ];
        }
    
        // Hiển thị nội dung biến session
    
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Book has been added to cart!');
    }
    
     
    public function updateCart(Request $request)
    {
        if($request->product_id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->product_id]["product_quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Book ad ded to cart.');
        }
    }
   
    public function deleteProduct(Request $request)
    {
        if($request->product_id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->product_id])) {
                unset($cart[$request->product_id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Book successfully deleted.');
        }
    }
}