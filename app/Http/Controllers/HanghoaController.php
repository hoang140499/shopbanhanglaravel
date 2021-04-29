<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Supprt\Facades\Redirect;
use App\Models\HangHoa;
use App\Models\NhomHangHoa;
use Illuminate\Support\Str;


class HanghoaController extends Controller
{
    //Hiển thị hàng hóa
	public function getThem(){
		$hanghoa = HangHoa::all();
		$nhomhanghoa = NhomHangHoa::all();
		return view('admin.quanlyhanghoa.them',['hanghoa'=>$hanghoa],['nhomhanghoa'=>$nhomhanghoa]);
	}

	//Thêm hàng hóa
	public function postThem(Request $request){
    	$this->validate($request,              //Kiểm tra lỗi
    		[
    			'MSHH' => 'required',   //Kiểm tra tên có rỗng không ít nhất 2 kí tự nhiều nhất 100
    			'TenHH' => 'required',
    			'Gia' => 'required',
    			'SoLuongHang' => 'required',
    			'MaNhom' => 'required',
    			'Hinh' => 'required',
    		]
    		,

    		[
    			'MSHH.required' => 'Bạn chưa nhập Mã nhóm',
    			'TenHH.required' => 'Bạn chưa nhập Tên hàng hóa',
    			'Gia.required' => 'Bạn chưa nhập Mã nhóm',
    			'SoLuongHang.required' => 'Bạn chưa nhập Giá',
    			'MaNhom.required' => 'Bạn chưa nhập Mã nhóm',
    			'Hinh.required' => 'Bạn chưa thêm Hình',
    		]);
		$hanghoa 				= new HangHoa;
		$hanghoa->MSHH 			= $request->MSHH;
		$hanghoa->TenHH 		= $request->TenHH;
		$hanghoa->Gia 			= $request->Gia;
		$hanghoa->SoLuongHang 	= $request->SoLuongHang;
		$hanghoa->MaNhom		= $request->MaNhom;   	
    	// $hanghoa->Hinh 			= $request->hasFile('Hinh');
		if ($request->hasFile('Hinh'))
		{	
			$file = $request->file('Hinh');
			$name = $file->getClientOriginalName();
			$hanghoa->Hinh = $name;
		}
		else {
			$hanghoa->Hinh = "";
		}
		// $hanghoa->HinhMinhHoa 	= $request->HinhMinhHoa;
		if ($request->hasFile('HinhMinhHoa'))
		{	

			$file = $request->file('HinhMinhHoa');
			for ($i=0; $i<count($file); $i++){
				$a = $request->HinhMinhHoa;
				$name = $a[$i]->getClientOriginalName().' ';
				$array[] = $name;

			}
		}
		else {
			$hanghoa->HinhMinhHoa = "";
		}
		var_dump($array);
		$chuoi = implode("", $array);
		echo $chuoi;
		$hanghoa->HinhMinhHoa	=$chuoi;
		$hanghoa->MoTaHH 		= $request->MoTaHH;
    	$hanghoa->save();

    	return redirect('admin/quanlyhanghoa/them')->with('thongbao-them','Thêm thành công');
	}

	public function postSua(Request $request, $MSHH){
        $this->validate($request,
            [
    			'MSHH' => 'required',   //Kiểm tra tên có rỗng không ít nhất 2 kí tự nhiều nhất 100
    			'TenHH' => 'required',
    			'Gia' => 'required',
    			'SoLuongHang' => 'required',
    			'MaNhom' => 'required',
    			'Hinh' => 'required',
    		]
    		,

    		[
    			'MSHH.required' => 'Bạn chưa nhập Mã nhóm',
    			'TenHH.required' => 'Bạn chưa nhập Tên hàng hóa',
    			'Gia.required' => 'Bạn chưa nhập Mã nhóm',
    			'SoLuongHang.required' => 'Bạn chưa nhập Giá',
    			'MaNhom.required' => 'Bạn chưa nhập Mã nhóm',
    			'Hinh.required' => 'Bạn chưa thêm Hình',
            ]);
        if ($request->hasFile('Hinh'))
		{	
			$file = $request->file('Hinh');
			$Hinh = $file->getClientOriginalName();
		}
		// $hanghoa->HinhMinhHoa 	= $request->HinhMinhHoa;
		if ($request->hasFile('HinhMinhHoa'))
		{	

			$file = $request->file('HinhMinhHoa');
			for ($i=0; $i<count($file); $i++){
				$a = $request->HinhMinhHoa;
				$name = $a[$i]->getClientOriginalName().' ';
				$array[] = $name;

			}
		}
		$chuoi = implode("", $array);
        $hanghoa = HangHoa::where('MSHH',$MSHH)
        ->update(['MSHH'=> $request->MSHH, 
        	'TenHH' => $request->TenHH, 
        	'Gia' =>$request->Gia, 
        	'Gia'=> $request->Gia, 
        	'SoLuongHang'=> $request->SoLuongHang, 
        	'Hinh'=> $Hinh, 
        	'HinhMinhHoa'=> $chuoi, 
        	'MoTaHH'=> $request->MoTaHH]);
        return redirect('admin/quanlyhanghoa/sua/'.$MSHH)->with('thongbao-sua','Sửa thành công');
    }

	public function getSua($MSHH){
		$hanghoa = HangHoa::all()->where('MSHH',$MSHH);
		$hanghoaAll = HangHoa::all();
		$nhomhanghoa = NhomHangHoa::all();
		return view('admin.quanlyhanghoa.sua',
			['hanghoa'=>$hanghoa],
			['nhomhanghoa'=>$nhomhanghoa])
			->with('hanghoaAll',$hanghoaAll);
	}
	public function getXoa($MSHH){
        $hanghoa = HangHoa::where('MSHH',$MSHH);
        $hanghoa -> delete();
        return redirect('admin/quanlyhanghoa/them')->with('thongbao-xoa','Xóa thành công');
    }
}
