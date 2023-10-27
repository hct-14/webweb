<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User_kh extends Authenticatable
{
    use HasFactory;

    protected $table="user_kh";
    protected $primaryKey="id";
    public $timestamps = false;


        public function khachhang(){
            return $this->belongsTo(Khach_hang::class, "MA_KH","MA_KH");
        }


        protected $casts = [
            'email_verified_at' => 'datetime',
        ];

}
