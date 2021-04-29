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
use App\Models\ChiTietDatHang;
use Illuminate\Support\Facades\Auth;

class DanhmucAjaxController extends Controller
{
    //
    function __construct(){
        $header = DatHang::selectRaw('count(id) as count')->where('TrangThai', 'ChuaXem')->first();
        view()->share('header',$header);    
        $today = date('d-m-Y H:i:s');
         view()->share('today',$today); 
    }

     public function trangchu(){ 
        $doanhthu_thang = DatHang::selectRaw('sum(TongTien) as sum_tien')
        ->whereMonth('NgayDH' , date('m'))
        ->first();

        $doanhthu_tong = DatHang::selectRaw('sum(TongTien) as sum_tien')
        ->first();

        $donhang_chuaduyet = DatHang::selectRaw('count(id) as count_id')
        ->where('TrangThai', 'ChuaXem')
        ->first();
        return view('admin-crud.content.trangchu',['doanhthu_thang'=>$doanhthu_thang],['doanhthu_tong'=>$doanhthu_tong])->with('donhang_chuaduyet', $donhang_chuaduyet); 
    }

    public function danhmuc(){
        if(request()->ajax()) {
            return datatables()->of(DanhMuc::select('*')) //csdl các bảng
            ->addColumn('action', 'admin-crud.content.company-action') //nút sửa xóa
            ->rawColumns(['action']) 
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin-crud.content.danhmuc');
    }

    public function storeDanhmuc(Request $request){   
        $danhmucId = $request->id;
 
        $danhmuc   =   DanhMuc::updateOrCreate(
                    [
                     'id' => $danhmucId
                    ],
                    [
                    'TenDanhMuc' => $request->TenDanhMuc
                    ]);    
                         
        return Response()->json($danhmuc);
 
    }
          
    //Hiển thị csdl khi nhấn vào edit
    public function editDanhmuc(Request $request)
    {   
        $where = array('id' => $request->id);
        $danhmuc  = DanhMuc::where($where)->first();
      
        return Response()->json($danhmuc);
    }

    public function deleteDanhmuc(Request $request)
    {
        $danhmuc = DanhMuc::where('id',$request->id)->delete();
        $max = DB::table('danhmuc')->max('id') + 1;
        DB::statement("ALTER TABLE danhmuc AUTO_INCREMENT =  $max");
        return Response()->json($danhmuc);
    }

}
