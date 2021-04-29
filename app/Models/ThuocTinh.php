<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThuocTinh extends Model
{
    use HasFactory;
    protected $table = "thuoc_tinh";
    protected $fillable = [ 'id', 'ten_thuoc_tinh' ];//dùng cho crud ajax khi them sua xoa
    public $timestamps = false;
    public function gia_tri_thuoc_tinh(){
    	return $this->hasMany('App\Models\GiaTriThuocTinh','id_thuoc_tinh','id');
    }
}

