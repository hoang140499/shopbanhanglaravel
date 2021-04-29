<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HangHoa extends Model
{
    use HasFactory;
    protected $table = "HangHoa";
    protected $fillable = [ 'id', 'TenHH', 'Gia', 'SoLuongHang', 'id_NHH', 'Hinh', 'HinhMinhHoa', 'id_gtri_thuoc_tinh_1', 'id_gtri_thuoc_tinh_2', 'MoTaHH' ];
    public $timestamps = false;
    public function nhomhanghoa(){
    	return $this->belongsTo('App\Models\NhomHangHoa','id_NHH','id');
    }

    public function gia_tri_thuoc_tinh_1(){
        return $this->belongsTo('App\Models\GiaTriThuocTinh','id_gtri_thuoc_tinh_1','id');
    }

    public function gia_tri_thuoc_tinh_2(){
        return $this->belongsTo('App\Models\GiaTriThuocTinh','id_gtri_thuoc_tinh_2','id');
    }

	// public function danhmuc(){
 //    	return $this->hasManyThrough('App\Models\DanhMuc','App\Models\NhomHangHoa','id','id','id_DM','id_NHH');
 //    }

    public function chitietdathang(){
    	return $this->hasMany('App\ChiTietDatHang','MSHH','MSHH');
    }
}
