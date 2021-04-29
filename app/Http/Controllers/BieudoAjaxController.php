<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\Models\HangHoa;
use App\Models\NhomHangHoa;
use App\Models\DanhMuc;
use App\Models\Comment;
use App\Models\Member;
use App\Models\ChiTietDatHang;
use App\Models\DatHang;
use Illuminate\Support\Facades\Auth;
use App\Charts\SampleChart;

class BieudoAjaxController extends Controller
{
    //
    function __construct(){
        $header = DatHang::selectRaw('count(id) as count')->where('TrangThai', 'ChuaXem')->first();
        view()->share('header',$header);    
        $today = date('d-m-Y H:i:s');
         view()->share('today',$today); 
    }
    public function bieudo()
    {
        $soluong = DB::table('chitietdathang')
		            ->join('dathang','dathang.id','chitietdathang.id_DH')
		        	->selectRaw('month(NgayDH) as thang, year(NgayDH) as nam, sum(SoLuong) as sum_sl, sum(GiaDatHang) as sum_gia, COUNT(DISTINCT id_DH) as count_sodon')
		            ->groupBy('thang')
		            ->groupBy('nam')
                    ->pluck('sum_sl');

        $tien = DB::table('chitietdathang')
		            ->join('dathang','dathang.id','chitietdathang.id_DH')
		        	->selectRaw('month(NgayDH) as thang, year(NgayDH) as nam, sum(SoLuong) as sum_sl, sum(GiaDatHang) as sum_gia, COUNT(DISTINCT id_DH) as count_sodon')
		            ->groupBy('thang')
		            ->groupBy('nam')
                    ->pluck('sum_gia');

        $chart = new SampleChart;
        $chart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);
        $chart->dataset('Tổng doanh thu', 'bar', $tien)->options([
            'fill' => 'true',
            'borderColor' => '#51C1C0',
            'borderWidth'=> 2
        ]);
        $chart->dataset('Tổng mặc hàng đã bán', 'bar', $soluong)->options([
            'fill' => 'true',
            'borderColor' => 'red',
            'borderWidth'=> 2
        ]);

        return view('admin-crud.content.bieudo', compact('chart'));
    }
}
