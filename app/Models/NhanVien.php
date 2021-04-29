<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhanVien extends Model
{
    use HasFactory;
    protected $table = "NhanVien";
    public $timestamps = false;
    public function dathang(){
    	return $this->hasMany('App\Models\DatHang','SoDonDH','SoDonDH');
    }
}
