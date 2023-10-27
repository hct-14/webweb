<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thuong_hieu extends Model
{
    use HasFactory;
    protected $table = 'btlcategory';
    protected $primaryKey = 'category_id ';
    public $timestamps = false;
    protected $thuonghieu = [
       'category_name',
    ];
  
    public function thongtinchitiet(){
        return $this->hasMany(Thong_tin_ct::class, "category_id","category_id");
    }
    public function sanpham(){
        return $this->hasMany(San_pham::class,"category_id","category_id");
    }
    public function quangcao(){
        return $this->belongsTo(Quang_cao::class,"MA_TH","MA_TH");
    }
}
