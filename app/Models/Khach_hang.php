<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khach_hang extends Model
{
    use HasFactory;
    protected $table = 'tbluser';
    protected $primaryKey = 'user_id';
    public $timestamps = false;


  
    public function users(){
        return $this->hasMany(User_kh::class,"user_id","user_id");
    }
public function giohang(){
    return $this->hasMany(Gio_hang::class, "user_id","user_id");
}

}
