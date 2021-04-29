<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use DB;
use App\Models\HangHoa;
use App\Models\NhomHangHoa;
use App\Models\DanhMuc;
use App\Models\Comment;
use App\Models\DatHang;
use App\Models\Member;
use App\Models\Khachhang;
use App\Models\ChiTietDatHang;
use Illuminate\Support\Facades\Auth;

class KhachhangAjaxController extends Controller
{
    //
    function __construct(){
        $header = DatHang::selectRaw('count(id) as count')->where('TrangThai', 'ChuaXem')->first();
        view()->share('header',$header);    
        $today = date('d-m-Y H:i:s');
         view()->share('today',$today); 
    }
    public function khachhang(){
    	if(request()->ajax()) {
            return datatables()->of(Khachhang::select('*')) //csdl các bảng
            ->addColumn('action', 'admin-crud.content.member-action') //nút sửa xóa
            ->rawColumns(['action']) 
            ->addIndexColumn()
            ->make(true);
        }
    	return view('admin-crud.content.khachhang');
    }
}
