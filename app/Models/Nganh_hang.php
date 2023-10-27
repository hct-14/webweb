<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nganh_hang extends Model
{
    use HasFactory;
    protected $table = 'nganh_hang';
    protected $primaryKey = 'MA_NH';
    public $timestamps = false;


    protected $nganhhang = [
        'TEN_NH','NH_CON','ANH_NH',
    ];

  
    
    public function thongtinchitiet(){
        return $this->hasMany(Thong_tin_ct::class, "MA_NH", "MA_NH");
    }
    public function sanpham(){
        return $this->hasMany(San_pham::class,"MA_NH","MA_NH");
    }
    
}
