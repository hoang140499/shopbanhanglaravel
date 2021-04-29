<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NhomHangHoa;
use App\Models\DanhMuc;
use Illuminate\Support\Facades\Redirect;
use DB;

class NhomhanghoaController extends Controller
{
    //Hiển thị danh sách nhóm hàng hóa (Thêm)
    public function getThem(){
    	$danhmuc = DanhMuc::all();
    	$nhomhanghoa = NhomHangHoa::all();
    	return view('admin.quanlynhomhanghoa.them',['nhomhanghoa'=>$nhomhanghoa], ['danhmuc'=>$danhmuc]);
    }

    //Thêm nhóm hàng hóa
    public function postThem(Request $request){
    	$this->validate($request,              //Kiểm tra lỗi
    		[
    			'TenNhom' => 'required|min:2|max:100',   //Kiểm tra tên có rỗng không ít nhất 2 kí tự nhiều nhất 100
	    	    'MaNhom' => 'required'
            ]
	    	,

	    	[
                'MaNhom.required' => 'Bạn chưa nhập Mã nhóm',
	    		'TenNhom.required' => 'Bạn chưa nhập Tên nhóm',
	    		'TenNHom.min' => 'Tên nhóm phải có độ dài >= 2',
	    		'TenNhom.max' => 'Tên nhóm phải có độ dài <=100',
	    	]);
    	$nhomhanghoa = new NhomHangHoa;
    	$nhomhanghoa->MaNhom = $request->MaNhom;
    	$nhomhanghoa->TenNhom = $request->TenNhom;
    	$nhomhanghoa->MaDanhMuc = $request->MaDanhMuc;

 		$nhomhanghoa->save();
 		return redirect('admin/quanlynhomhanghoa/them')->with('thongbao-them','Thêm thành công');
    }
    

    //Hiển thị danh sách nhóm hàng hóa (Sửa)
    public function getSua($MaNhom){
        $nhomhanghoaAll = NhomHangHoa::all();
        $danhmuc = DanhMuc::all();
        $nhomhanghoa = NhomHangHoa::all()->where('MaNhom',$MaNhom);
        return view('admin.quanlynhomhanghoa.sua',
            ['nhomhanghoa'=>$nhomhanghoa],
            ['danhmuc' =>$danhmuc],
        )->with('nhomhanghoaAll',$nhomhanghoaAll);
    }

    //Sửa loại sản phẩm
    public function postSua(Request $request, $MaNhom){
        $this->validate($request,
            [
                'MaNhom' => 'required',
                'TenNhom' => 'required|min:2|max:100'
            ],
            [
                'MaNhom.required' => 'Bạn chưa nhập Mã nhóm',
                'TenNhom.required' =>'Bạn chưa nhập Tên nhóm',
                'TenNhom.min' => 'Tên nhóm phải có độ dài >=2',
                'TenNhom.max' => 'Tên nhóm phải có độ dài <=100'
            ]);
        $nhomhanghoa = NhomHangHoa::where('MaNhom',$MaNhom)
        ->update(['MaNhom'=> $request->MaNhom, 'TenNhom' => $request->TenNhom, 'MaDanhMuc' =>$request->MaDanhMuc]);
        // ->update(['MaDanhMuc' => $request->MaDanhMuc, 'TenDanhMuc' => $request->TenDanhMuc]);
        return redirect('admin/quanlynhomhanghoa/sua/'.$MaNhom)->with('thongbao-sua','Sửa thành công');;
    }

    //Xóa loại sản phẩm
    public function getXoa($MaNhom){
        $nhomhanghoa = NhomHangHoa::where('MaNhom',$MaNhom);
        $nhomhanghoa -> delete();
        return redirect('admin/quanlynhomhanghoa/them')->with('thongbao-xoa','Xóa thành công');
    }
}
