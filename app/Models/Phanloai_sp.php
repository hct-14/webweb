<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phanloai_sp extends Model
{
    use HasFactory;
    protected $table="phan_loai_sp";
    protected $primaryKey="ID_PL";
    public $timestamps = false;
    public function chitietsp(){
        return $this->hasMany(Ct_sanpham::class,"ID_PL","ID_PL");
    }
}
