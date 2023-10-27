<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User_nv extends Authenticatable
{
    use HasFactory;
    protected $table = "user_nv";
    protected $primaryKey = "id";
    public $timestamps = false;
 
    public function nhanvien(){
        return $this->belongsTo(Nhan_vien::class,"MA_NV" ,"MA_NV");
        
        }
        

           /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        // protected $fillable = [
        // 'ten_dn', 'pass_dn',
        // ];
    
        /**
         * The attributes that should be hidden for arrays.
         *
         * @var array
         */
        // protected $hidden = [
        //     'pass_dn', 'remember_token',
        // ];
    
        /**
         * The attributes that should be cast to native types.
         *
         * @var array
         */
        protected $casts = [
            'email_verified_at' => 'datetime',
        ];


}
