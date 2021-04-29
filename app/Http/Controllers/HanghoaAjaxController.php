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
use App\Models\ChiTietDatHang;
use App\Models\ThuocTinh;
use App\Models\GiaTriThuocTinh;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class HanghoaAjaxController extends Controller
{
    //
    function __construct(){
        $header = DatHang::selectRaw('count(id) as count')->where('TrangThai', 'ChuaXem')->first();
        view()->share('header',$header);    
        $today = date('d-m-Y H:i:s');
         view()->share('today',$today); 
    }
   public function hanghoa(){
    $nhomhanghoa = NhomHangHoa::all();
    $hanghoa = HangHoa::all();
    $gia_tri_thuoc_tinh_1 = GiaTriThuocTinh::all()->where('id_thuoc_tinh', 1);
    $gia_tri_thuoc_tinh_2 = GiaTriThuocTinh::all()->where('id_thuoc_tinh', 2);
    if(request()->ajax()) {
            return datatables()->of(HangHoa::select('*')
            ->with('nhomhanghoa')
            ->with('gia_tri_thuoc_tinh_1') //csdl các bảng
            ->with('gia_tri_thuoc_tinh_2')) //csdl các bảng
            ->addColumn('action', 'admin-crud.content.company-action') //nút sửa xóa
            ->rawColumns(['action']) 
            ->addIndexColumn()
            ->make(true);
        }
        //return view('admin-crud.content.hanghoa');        
        return view('admin-crud.content.hanghoa', 
            compact('nhomhanghoa'), 
            compact('hanghoa'))
        ->with('gia_tri_thuoc_tinh_1', $gia_tri_thuoc_tinh_1)
        ->with('gia_tri_thuoc_tinh_2', $gia_tri_thuoc_tinh_2);
    }

    public function storeHanghoa(Request $request){   
        $hanghoaId = $request->id;

        //Hình
        if ($request->hasFile('Hinh'))
        {   
            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
        }
        else {
            $name = "";
        }

        //Hình minh họa
        if ($request->hasFile('HinhMinhHoa'))
        {   

            $file = $request->file('HinhMinhHoa');
            for ($i=0; $i<count($file); $i++){
                $a = $request->HinhMinhHoa;
                $hmh = $a[$i]->getClientOriginalName().' ';
                $array[] = $hmh;
            }
        }
        else {
            $hmh  = "";
        }
        $chuoi = implode("", $array);
        $MoTaHH = $request->noidung;
        $hanghoa   =   HangHoa::updateOrCreate(
            [
                'id' => $hanghoaId //id de xoa san pham
           ],
           [
                'id' => $hanghoaId,//id de them san pham
                'TenHH' => $request->TenHH,
                'Gia' => $request->Gia,
                'SoLuongHang' => $request->SoLuongHang,
                'id_NHH' => $request->id_NHH,
                'Hinh' => $name,
                'HinhMinhHoa' => $chuoi,
                'id_gtri_thuoc_tinh_1' => $request->id_gtri_thuoc_tinh_1,
                'id_gtri_thuoc_tinh_2' => $request->id_gtri_thuoc_tinh_2,
                'MoTaHH' => $MoTaHH,
            ]);    

        return Response()->json($hanghoa);

        //return Response()->json($request->all());

    }

    public function editHanghoa(Request $request)
    {   
        // $where = array('id' => $request->id);
        $hanghoa  = HangHoa::where('id', $request->id)->first();
      
        return Response()->json($hanghoa);
    } 

    public function deleteHanghoa(Request $request)
    {
        $hanghoa = HangHoa::where('id', $request->id)->delete();
        return Response()->json($hanghoa);
    }
}
