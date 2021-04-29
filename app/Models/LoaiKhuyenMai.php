<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiKhuyenMai extends Model
{
    use HasFactory;
    protected $table = "loai_khuyen_mai";
    protected $fillable = [ 'id', 'tieu_de', 'muc_giam', 'ngay_bat_dau', 'ngay_ket_thuc' ];//dùng cho crud ajax khi them sua xoa
    public $timestamps = false;
    public function khuyen_mai(){
    	return $this->hasMany('App\Models\KhuyenMai','id_loai_khuyen_mai','id');
    }
}

