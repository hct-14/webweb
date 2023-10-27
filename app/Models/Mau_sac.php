<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mau_sac extends Model
{
    use HasFactory;
    protected $table="mau_sac";
    protected $primaryKey="MA_MAU";
    public $timestamps = false;
public function thontinctsp(){
    return $this->hasMany(Ct_sanpham::class,"MA_MAU","MA_MAU");
}
}
