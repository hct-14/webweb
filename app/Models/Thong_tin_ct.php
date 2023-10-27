<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thong_tin_ct extends Model
{
    use HasFactory;
    protected $table = 'thong_tin_chi_tiet';
    protected $primaryKey = 'MA_TTCT';
    public $timestamps = false;
        protected $thongtin_ct = [
        'TEN_TTCT','NOIDUNG_OPTION',
    ];
    public function nganhhang(){
        return $this->belongsTo(Nganh_hang::class, "MA_NH", "MA_NH");
    }
    public function thuonghieu(){
        return $this->belongsTo(Thuong_hieu::class,"MA_TH","MA_TH");
    }
    
}
