<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhuyenMai extends Model
{
    use HasFactory;
    protected $table = "khuyen_mai";
    protected $fillable = [ 'id', 'id_HH', 'id_loai_khuyen_mai' ];//dùng cho crud ajax khi them sua xoa
    public $timestamps = false;
    public function loai_khuyen_mai(){
    	return $this->belongsTo('App\Models\LoaiKhuyenMai','id_loai_khuyen_mai','id');
    }
}

