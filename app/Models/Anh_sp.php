<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anh_sp extends Model
{
    use HasFactory;

protected $table="anh_sp";
protected $primaryKey="ID_ANHSP";
public $timestamps = false;

public function sanpham(){
    return $this->belongsTo(San_pham::class,"MA_SP","MA_SP");

}
}
