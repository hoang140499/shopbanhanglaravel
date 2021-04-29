<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhMuc;
use Illuminate\Support\Facades\Redirect;
use DB;
use Illuminate\Support\Facades\Auth;

class DanhmucController extends Controller
{
    
    // public function __construct(){
    //     $this->middleware('member');
    // }
    public function getTrangchu(){
        return view('admin.layout.index');
    }

    //Them loai danh muc
    public function getThem(){
    	$danhmuc = DanhMuc::all();
    	return view('admin.quanlydanhmuc.them',['danhmuc' => $danhmuc]);
    }
    public function postThem(Request $request){ //requese nhận dữ liệu từ form
    	$this->validate($request,              //Kiểm tra lỗi
    		[
    			'TenDanhMuc' => 'required|min:2|max:100',  //Kiểm tra tên có rỗng không ít nhất 2 kí tự nhiều nhất 100
	    	    'MaDanhMuc' => 'required'
            ]
	    	,

	    	[
                'MaDanhMuc.required' =>  'Bạn chưa nhập Mã danh mục',
	    		'TenDanhMuc.required' => 'Ban chưa nhập Tên danh mục',
	    		'TenDanhMuc.min' => 'Tên danh mục phải có độ dài >= 2',
	    		'TenDanhMuc.max' => 'Tên danh mục phải có độ dài <=100',
	    	]);
    	$danhmuc = new DanhMuc;
    	$danhmuc->MaDanhMuc = $request->MaDanhMuc;
    	$danhmuc->TenDanhMuc = $request->TenDanhMuc;

 		$danhmuc->save();
 		return redirect('admin/quanlydanhmuc/them')->with('thongbao-them','Thêm thành công');
    }

    //sua loai danh muc
    public function getSua($MaDanhMuc){
        $danhmucAll = DanhMuc::all();
        $danhmuc = DanhMuc::all()->where('MaDanhMuc',$MaDanhMuc);
        return view('admin.quanlydanhmuc.sua',['danhmuc'=>$danhmuc],['danhmucall'=>$danhmucAll]);	
    }


    public function postSua(Request $request, $MaDanhMuc){

         $this->validate($request,
            [
                'TenDanhMuc' => 'required|unique:danhmuc,MaDanhMuc',
            ]
            ,[
                'TenDanhMuc.required' => 'Bạn chưa nhập Tên danh mục' ,
                'TenDanhMuc.unique' => 'Tên danh mục đã tồn tại' 
            ]);
        $danhmuc = DB::table('danhmuc')
        ->where('MaDanhMuc',$MaDanhMuc)
        ->update(['MaDanhMuc' => $request->MaDanhMuc, 'TenDanhMuc' => $request->TenDanhMuc]);
        return redirect('admin/quanlydanhmuc/sua/'.$MaDanhMuc)->with('thongbao','Sửa thành công');
    }

    //xoa loai danh muc
    public function getXoa($MaDanhMuc){
        $danhmuc = DanhMuc::where('MaDanhMuc',$MaDanhMuc);
        $danhmuc -> delete();
        return redirect('admin/quanlydanhmuc/them')->with('thongbao-xoa','Xóa thành công');
    }
}
