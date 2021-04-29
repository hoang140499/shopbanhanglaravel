<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KhachHang;
use Illuminate\Support\Facades\Redirect;
use DB;

class KhachhangController extends Controller
{
    //
	public function getThem(){
		$khachhang = KhachHang::all();
		return view ('admin.quanlykhachhang.them',compact('khachhang'));
	}

	public function getXoa($id){
		$khachhang = KhachHang::where('id',$id);
		$khachhang -> delete();
		$max = DB::table('khachhang')->max('id') + 1;
        DB::statement("ALTER TABLE khachhang AUTO_INCREMENT =  $max");
        $max1 = DB::table('dathang')->max('SoDonDH') + 1;
        DB::statement("ALTER TABLE dathang AUTO_INCREMENT =  $max1");
        $max2 = DB::table('chitietdathang')->max('SoDonDH') + 1;
        DB::statement("ALTER TABLE chitietdathang AUTO_INCREMENT =  $max2");
		return redirect('admin/quanlykhachhang/them')->with('thongbao-xoa','Xóa thành công');
	}

	public function getSua($id){
		$khachhangAll = KhachHang::all();
		$khachhang = KhachHang::all()->where('id',$id);
		return view('admin.quanlykhachhang.sua',compact('khachhang','khachhangAll'));
	}

	public function postSua(Request $request, $id){

		$this->validate($request,
			[
				'id' => 'required',
				'HoTenKH' => 'required',
				'DiaChi' => 'required',
				'SoDienThoai' => 'required',
			]
			,[
				'id.required' => 'Bạn chưa nhập id' ,
				'HoTenKH.required' => 'Bạn chưa nhập Họ Tên KH' ,
				'DiaChi.required' => 'Bạn chưa nhập Địa chỉ' ,
				'SoDienThoai.required' => 'Bạn chưa nhập Số điện thoại' ,
			]);
		$khachhang = DB::table('khachhang')
		->where('id',$id)
		->update(['id' => $request->id, 'HoTenKH' => $request->HoTenKH, 'DiaChi' => $request->DiaChi, 'SoDienThoai' => $request->SoDienThoai]);
		return redirect('admin/quanlykhachhang/sua/'.$id)->with('thongbao-sua','Sửa thành công');
	}
}
