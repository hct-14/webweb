<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class San_pham extends Model
{
    use HasFactory;

    protected $table="tblproduct";
    protected $primaryKey ="product_id";

    public function setCreatedAtAttribute($value)
{
    $this->attributes['created_at'] = \Carbon\Carbon::now();
}

protected $fillable = [
    'product_title', 'product_description','created_at'
];

// public function nganhhang(){
//     return $this->belongsTo(Nganh_hang::class, "MA_NH","MA_NH");
// }
public function thuonghieu(){
    return $this->belongsTo(Thuong_hieu::class, "product_brand","product_brand");
}
public function anhsp(){
    return $this->hasMany(Anh_sp::class,"product_id", "product_id");
}
public function chitietsp(){
    return $this->hasMany(Ct_sanpham::class,"product_id","product_id");
}
// public function nhanvien(){
//     return $this->hasMany(Nhan_vien::class,"MA_NV","MA_NV");
// }
}
