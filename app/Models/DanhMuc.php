<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    use HasFactory;
    protected $table = "danhmuc";
    protected $fillable = [ 'id', 'TenDanhMuc' ];//dùng cho crud ajax khi them sua xoa
    public $timestamps = false;
    public function nhomhanghoa(){
    	return $this->hasMany('App\Models\NhomHangHoa','id_DM','id');
    }

    public function hanghoa(){
    	return $this->hasManyThrough('App\Models\HangHoa','App\Models\NhomHangHoa','id_DM','id_NHH','id','id');

      //ts1: model tintuc: thang CHAU can lay
      //ts2: model loaitin: la model trung gian CHA
      //ts3: khai bao khoa phu cua loaitin, trung gian noi voi theloai
      //ts4: khai bao khoa phuc cua tintuc, thang con noi qua trung gian
      //ts5: khoa chinh cua bang theloai ONG
      //ts6:Tên khóa chính của model trung gian
      // select `HangHoa`.*, `NhomHangHoa`.`MaDanhMuc` as `laravel_through_key` from `HangHoa` inner join `NhomHangHoa` on `NhomHangHoa`.`MaNhom` = `HangHoa`.`MaNhom` where `NhomHangHoa`.`MaDanhMuc` = 1
    }
}

