<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use DB;
use App\Models\HangHoa;
use App\Models\NhomHangHoa;
use App\Models\DanhMuc;
use App\Models\Comment;
use App\Models\ChiTietDatHang;
use App\Models\KhachHang;
use App\Models\DatHang;
use Illuminate\Support\Facades\Auth;

class CommentAjaxController extends Controller
{
    //
    function __construct(){
        $header = DatHang::selectRaw('count(id) as count')->where('TrangThai', 'ChuaXem')->first();
        view()->share('header',$header);    
        $today = date('d-m-Y H:i:s');
         view()->share('today',$today); 
    }
    public function comment(){
    	 if(request()->ajax()) {
            return datatables()->of(Comment::with('khachhang')
            ->with('hanghoa')
            ->select('*')) //csdl các bảng
            ->addColumn('action', 'admin-crud.content.donhang-action') //nút sửa xóa
            ->rawColumns(['action']) 
            ->addIndexColumn()
            ->make(true);
        }
    	return view('admin-crud.content.comment');
    }
}
