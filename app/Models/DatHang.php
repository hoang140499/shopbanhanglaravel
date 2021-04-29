<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatHang extends Model
{
    use HasFactory;
    protected $table = "DatHang";
    protected $fillable = [ 'id', 'id_KH', 'NgayDH', 'TongSoLuong', 'TongTien', 'TrangThai' ];
    public $timestamps = false;

    public function khachhang(){
    	return $this->belongsTo('App\Models\KhachHang','id_KH','id');
    }
    public function chitietdathang(){
    	return $this->hasMany('App\Models\ChiTietDatHang','id_DH','id');
    }
}
