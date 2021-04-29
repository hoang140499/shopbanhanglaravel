<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Suport\Facades\Redirect;
use App\Models\NhanVien;
use DB;


class NhanvienController extends Controller
{
    public function getThem(){
    	$nhanvien = NhanVien::all();
    	return view('admin.quanlynhanvien.them',['nhanvien'=>$nhanvien]);
    }
    public function postThem(Request $request){
        $this->validate($request,
            [
                'HoTenNV' => 'required|min:2|max:100',
                'ChucVu' => 'required|min:2|max:100',
                'DiaChi' => 'required|min:2|max:100',
                'SoDienThoai' => 'required|min:10|max:10',

            ],
            [
                'HoTenNV.required' => 'Bạn chưa nhập Họ tên nhân viên',
                'ChucVu.required' => 'Bạn chưa nhập Chức vụ',
                'DiaChi.required' => 'Bạn chưa nhập Địa chỉ',
                'SoDienThoai.required' => 'Bạn chưa nhập Số điện thoại',
                'SoDienThoai.min' => 'Số điện thoại phải là 10 số',
                'SoDienThoai.max' => 'Số điện thoại phải là 10 số'
            ]);
        $nhanvien = new NhanVien;
        $nhanvien->MSNV = $request->MaNV;
        $nhanvien->HoTenNV = $request->HoTenNV;
        $nhanvien->ChucVu = $request->ChucVu;
        $nhanvien->DiaChi = $request->DiaChi;
        $nhanvien->SoDienThoai = $request->SoDienThoai;
        $nhanvien->save();

        return redirect('admin/quanlynhanvien/them')->with('thongbao-them','Thêm thành công');
    }

    public function getSua($MSNV){
        $nhanvienAll = NhanVien::all();
        $nhanvien = NhanVien::all()->where('MSNV', $MSNV);
        return view('admin.quanlynhanvien.sua',['nhanvienAll'=>$nhanvienAll], ['nhanvien'=>$nhanvien]); 
    }
    public function postSua(Request $request, $MSNV){
        $this->validate($request,
            [
                'MaNV' => 'required',
                'HoTenNV' => 'required|min:2|max:100',
                'ChucVu' => 'required|min:2|max:100',
                'DiaChi' => 'required|min:2|max:100',
                'SoDienThoai' => 'required|min:10|max:10',

            ],
            [
                'MaNV.required' => 'Bạn chưa nhập Mã nhân viên',
                'HoTenNV.required' => 'Bạn chưa nhập Họ tên nhân viên',
                'ChucVu.required' => 'Bạn chưa nhập Chức vụ',
                'DiaChi.required' => 'Bạn chưa nhập Địa chỉ',
                'SoDienThoai.required' => 'Bạn chưa nhập Số điện thoại',
                'SoDienThoai.min' => 'Số điện thoại phải là 10 số',
                'SoDienThoai.max' => 'Số điện thoại phải là 10 số'
            ]);
        $nhanvien = NhanVien::where('MSNV', $MSNV)
        ->update(['MSNV'=>$request->MaNV, 'HoTenNV'=>$request->HoTenNV, 'ChucVu'=>$request->ChucVu, 'DiaChi'=>$request->DiaChi, 'SoDienThoai'=>$request->SoDienThoai]);
        return redirect('admin/quanlynhanvien/sua/'.$MSNV)->with('thongbao-sua','Sửa thành công');
    }

    public function getXoa($MSNV){
        $nhanvien = NhanVien::where('MSNV',$MSNV);
        $nhanvien->delete();
        return redirect('admin/quanlynhanvien/them')->with('thongbao-xoa','Xóa thành công');
    }
}
