<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietDatHang extends Model
{
    use HasFactory;
    protected $table = "ChiTietDatHang";
    public $timestamps = false;
    public function hanghoa(){
    	return $this->belongsTo('App\Models\HangHoa','id_HH','id');
    }
    public function dathang(){
    	return $this->belongsTo('App\Models\DatHang','id_DH','id');
    }
}
