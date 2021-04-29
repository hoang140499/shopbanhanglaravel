<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use DB;
use App\Models\HangHoa;
use App\Models\NhomHangHoa;
use App\Models\DanhMuc;
use App\Models\DatHang;
use App\Models\Comment;
use App\Models\ChiTietDatHang;
use Illuminate\Support\Facades\Auth;


class NhomhanghoaAjaxController extends Controller
{
    //
    function __construct(){
        $header = DatHang::selectRaw('count(id) as count')->where('TrangThai', 'ChuaXem')->first();
        view()->share('header',$header);    
        $today = date('d-m-Y H:i:s');
         view()->share('today',$today); 
    }
    public function nhomhanghoa(){
    	$danhmuc = DanhMuc::all();
        if(request()->ajax()) {
            return datatables()->of(NhomHangHoa::with('danhmuc')->select('*')) //csdl các bảng
            ->addColumn('action', 'admin-crud.content.company-action') //nút sửa xóa
            ->rawColumns(['action']) 
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin-crud.content.nhomhanghoa',compact('danhmuc'));
    }

    public function storeNhomhanghoa(Request $request){   
        $nhomhanghoaId = $request->id;
 
        $nhomhanghoa   =   NhomHangHoa::updateOrCreate(
                    [
                     'id' => $nhomhanghoaId
                    ],
                    [
                    'TenNhom' => $request->TenNhom,
                    'id_DM' => $request->id_DM
                    ]);    
                         
        return Response()->json($nhomhanghoa);
 
    }
          
    //Hiển thị csdl khi nhấn vào edit
    public function editNhomhanghoa(Request $request)
    {   
        $where = array('id' => $request->id);
        $nhomhanghoa  = NhomHangHoa::where($where)->first();
      
        return Response()->json($nhomhanghoa);
    } 

    public function deleteNhomhanghoa(Request $request)
    {
        $nhomhanghoa = NhomHangHoa::where('id',$request->id)->delete();
        $max = DB::table('nhomhanghoa')->max('id') + 1;
        DB::statement("ALTER TABLE nhomhanghoa AUTO_INCREMENT =  $max");
        return Response()->json($nhomhanghoa);
    }
}
