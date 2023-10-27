<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nhan_vien extends Model
{
    use HasFactory;
    protected $table = "nhan_vien";
    protected $primaryKey = "MA_NV";
    public $timestamps = false;
  
    public function users(){
        return $this->hasMany(User_nv::class,"MA_NV","MA_NV");
    }
    public function sanpham(){
        return $this->belongsTo(San_pham::class,"MA_NV","MA_NV");
    }


}
