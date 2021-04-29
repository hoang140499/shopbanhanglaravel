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

class DonhangAjaxController extends Controller
{
    //
    function __construct(){
        $header = DatHang::selectRaw('count(id) as count')->where('TrangThai', 'ChuaXem')->first();
        view()->share('header',$header);    
        $today = date('d-m-Y H:i:s');
         view()->share('today',$today); 
    }
    public function donhang(){
        if(request()->ajax()) {
            return datatables()->of(DatHang::with('khachhang')
            ->select('*')
            ->where('TongTien', '<>' , 0)) //csdl các bảng
            ->addColumn('action', 'admin-crud.content.donhang-action') //nút sửa xóa
            ->rawColumns(['action']) 
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin-crud.content.donhang');
    }

    public function storeDonhang(Request $request){   
        $donhangId = $request->id;
        //Cach1: Dùng hàm update
        $donhang = DatHang::where('id', $donhangId)->update(['TrangThai' => $request->TrangThai]);

        //Cách 2: dùng hàm updateOrCreate
        // $donhang   =   DatHang::updateOrCreate(
        //             [
        //              'id' => $donhangId
        //             ],
        //             [
        //             'TrangThai' => $request->TrangThai
        //             ]);    
                         
        return Response()->json($donhang);
 
    }
          
    //Hiển thị csdl khi nhấn vào edit
    public function editDonhang(Request $request)
    {   
        $where = array('id' => $request->id);
        $donhang  = DatHang::where($where)->first();
      
        return Response()->json($donhang);
    } 

    public function detailDonhang(Request $request)
    {   
        $chitietdathang  = DB::table('chitietdathang')->select('*')
        ->where('id_DH', $request->id)
        ->join('hanghoa', 'hanghoa.id', 'chitietdathang.id_HH')
        ->join('dathang', 'dathang.id', 'chitietdathang.id_DH')
        ->where('GiaDatHang', '<>' , 0)
        ->get()
        ;
        return Response()->json($chitietdathang);
    } 

}
