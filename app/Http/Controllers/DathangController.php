<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DatHang;
use App\Models\NhanVien;
use App\Models\KhachHang;
use Illuminate\Support\Facades\Redirect;
use DB;

class DathangController extends Controller
{
    //
    public function getThem(){
    	$dathang = DB::table('DatHang')
    	->join('KhachHang','KhachHang.id','DatHang.ID_KH')
    	->get();
    	return view('admin.quanlydathang.them',compact('dathang'));
    }

    public function getSua($SoDonDH){
    	$dathangAll = DB::table('DatHang')
    	->join('KhachHang','KhachHang.id','DatHang.ID_KH')
    	->get();
    	$dathang = DatHang::all()->where('SoDonDH',$SoDonDH);
    	return view('admin.quanlydathang.sua',compact('dathangAll', 'dathang'));
    }

    public function postSua(Request $request, $SoDonDH){
    	$dathang = DB::table('dathang')
    	->where('SoDonDH',$SoDonDH)
    	->update(['TrangThai' => $request->TrangThai ]);
    	return redirect('admin/quanlydathang/sua/'.$SoDonDH)->with('thongbao-sua','Sửa thành công');
    }

}
