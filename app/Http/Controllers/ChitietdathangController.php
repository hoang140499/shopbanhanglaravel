<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChiTietDatHang;
use App\Models\HangHoa;
use Illuminate\Support\Facades\Redirect;
use DB;

class ChitietdathangController extends Controller
{
    //
    function __construct(){
    	$hanghoa = HangHoa::all();
    	view()->share('hanghoa',$hanghoa);		
	}
    public function getThem(){

    	$chitietdathang = DB::table('ChiTietDatHang')
    	->join('HangHoa','HangHoa.MSHH','ChiTietDatHang.MSHH')->get();
    	return view('admin.quanlychitietdathang.them',compact('chitietdathang'));
    }
}
