<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhomHangHoa extends Model
{
    use HasFactory;
    protected $table = "NhomHangHoa";
    protected $fillable = [ 'id', 'TenNhom', 'id_DM' ];
    public $timestamps = false;
    public function danhmuc(){
    	return $this->belongsTo('App\Models\DanhMuc','id_DM','id');
    }

    public function hanghoa(){
    	return $this->hasMany('App\Models\HangHoa','MaNhom','MaNhom');
    }
}
