<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YeuThich extends Model
{
    use HasFactory;
    protected $table = "yeuthich";
    public $timestamps = false;
    protected $fillable = [
        'id','id_HH','id_KH','liked'
    ];

    public function hanghoa(){
    	return $this->belongsTo('App\Models\HangHoa','id_HH','id');
    }
    public function khachhang(){
    	return $this->belongsTo('App\Models\KhachHang','id_KH','id');
    }
}