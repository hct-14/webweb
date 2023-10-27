<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Book extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'product_title', 
        'product_author', 
        'product_image', 
        'product_price'
    ];
}