<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class Cart {
    public $product = null;
    public $totalPrice;
    public $totalQuanty;


        public function _contains($cart){
            if($cart){
                $this->product = $cart->product;
                $this->totalPrice = $cart->totalPrice;
                $this->totalQuanty = $cart->totalQuanty;

            }
        }
        public function Addcart($product, $productId){
            $newProduct = [
                'quanty' => 1,
                'productInfo' =>$product
            ];
            if($this->product ){
                if(array_key_exists($productId, $product)){
                    $newProduct = $product[$productId];

                }
            }
            $newProduct['quanty']++;
            $newProduct['price'] = $newProduct['quanty'] * $product->price;
            $this->product[$productId]=$newProduct;
            $this->totalPrice += $product->price;
            $this->totalQuanty++;
        }
}
?>
