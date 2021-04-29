<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiaTriThuocTinh extends Model
{
    use HasFactory;
    protected $table = "gia_tri_thuoc_tinh";
    protected $fillable = [ 'id', 'id_thuoc_tinh', 'gia_tri' ];//dùng cho crud ajax khi them sua xoa
    public $timestamps = false;
    public function thuoc_tinh(){
    	return $this->belongsTo('App\Models\ThuocTinh','id_thuoc_tinh','id');
    }
}

