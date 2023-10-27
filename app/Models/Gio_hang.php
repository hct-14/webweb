<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gio_hang extends Model
{
    use HasFactory;

    protected $table="tblorder";
    protected $primaryKey="order_id ";
    public $timestamps = false;
    public function khachhang(){
        return $this->belongsTo(Khach_hang::class,"user_id ","user_id ");
    }
}
