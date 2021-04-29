<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = "Comment";
    public $timestamps = false;
    public function hanghoa(){
    	return $this->belongsTo('App\Models\HangHoa','id_HH','id');
    }
    public function khachhang(){
    	return $this->belongsTo('App\Models\KhachHang','id_KH','id');
    }
}