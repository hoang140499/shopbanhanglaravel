<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class KhachHang extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'khachhang';
    // public $timestamps = false;

    protected $fillable = [
        'HoTenKH','email','DiaChi','SoDienThoai','password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // Các trường thuộc hidden là cá trường ẩn không lấy dc giá trị hiển thị
        // 'password', 
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

// class KhachHang extends Model
// {
//     use HasFactory;
//     protected $table = "KhachHang";
//     public $timestamps = false;
// }
