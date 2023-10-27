<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ct_sanpham extends Model
{
    use HasFactory;
    protected $table="chi_tiet_sp";
    protected $primaryKey="ID_CTSP";
    public $timestamps = false;
    public function mausac(){
        return $this->belongsTo(Mau_sac::class, "MA_MAU","MA_MAU");
    }
    public function phanloai(){
        return $this->belongsTo(Phanloai_sp::class,"ID_PL","ID_PL");

    }
    public function sanpham(){
        return $this->belongsTo(San_pham::class,"MA_SP","MA_SP");
    }
}
