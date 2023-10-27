<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quang_cao extends Model
{
    use HasFactory;

    protected $table="quang_cao";
    protected $primaryKey="ID_QC";
    public $timestamps=false;

    public function thuonghieu(){
        return $this->hasMany(Thuong_hieu::class,"MA_TH","MA_TH");
    }
    


}
