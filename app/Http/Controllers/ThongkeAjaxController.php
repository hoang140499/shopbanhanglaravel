<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use DB;
use App\Models\HangHoa;
use App\Models\NhomHangHoa;
use App\Models\DanhMuc;
use App\Models\Comment;
use App\Models\ChiTietDatHang;
use App\Models\DatHang;
use Illuminate\Support\Facades\Auth;
use App\Charts\SampleChart;

class ThongkeAjaxController extends Controller
{
    function __construct(){
        $header = DatHang::selectRaw('count(id) as count')->where('TrangThai', 'ChuaXem')->first();
        view()->share('header',$header);    
        $today = date('d-m-Y H:i:s');
         view()->share('today',$today); 
    }

    // SELECT month(NgayDH) as thang, sum(GiaDatHang) as tong, sum(SoLuong) as sl
    // FROM `chitietdathang` INNER JOIN dathang
    // ON dathang.id = chitietdathang.id_DH
    // WHERE year(NgayDH) = 2021
    // GROUP BY month(NgayDH)
    public function thongke(){    	
  //   	$sum = ChiTietDatHang::groupBy('id_DH')
  //   	 ->selectRaw('id_DH, sum(SoLuong) as sumsl, sum(GiaDatHang) as sumgia')
		//  ->get();
		// ;
    	if(request()->ajax()) {
        return datatables()->of(DB::table('chitietdathang')
            ->join('dathang','dathang.id','chitietdathang.id_DH')
        	->selectRaw('month(NgayDH) as thang, year(NgayDH) as nam, sum(SoLuong) as sum_sl, sum(GiaDatHang) as sum_gia, COUNT(DISTINCT id_DH) as count_sodon')
            ->where('SoLuong' , '<>', 0)
            ->groupBy('thang')
            ->groupBy('nam')
            ->where('TrangThai' , '=', 'HoanThanh')
    		)
            ->addColumn('action', 'admin-crud.content.thongke-action') //nút sửa xóa
            ->rawColumns(['action']) 
            ->addIndexColumn()
            ->make(true);
        }
         $soluong = DB::table('chitietdathang')
                    ->join('dathang','dathang.id','chitietdathang.id_DH')
                    ->selectRaw('month(NgayDH) as thang, year(NgayDH) as nam, sum(SoLuong) as sum_sl, sum(GiaDatHang) as sum_gia, COUNT(DISTINCT id_DH) as count_sodon')
                    ->groupBy('thang')
                    ->groupBy('nam')
                    ->where('TrangThai' , '=', 'HoanThanh')
                    ->pluck('sum_sl');

        $tien = DB::table('chitietdathang')
                    ->join('dathang','dathang.id','chitietdathang.id_DH')
                    ->selectRaw('month(NgayDH) as thang, year(NgayDH) as nam, sum(SoLuong) as sum_sl, sum(GiaDatHang) as sum_gia, COUNT(DISTINCT id_DH) as count_sodon')
                    ->groupBy('thang')
                    ->groupBy('nam')
                    ->where('TrangThai' , '=', 'HoanThanh')
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

        return view('admin-crud.content.thongke', compact('chart'));
    }

        public function detailThongke(Request $request)
    {   

        // SELECT * FROM `chitietdathang` 
        // INNER JOIN dathang
        // ON chitietdathang.id_DH = dathang.id
        // INNER JOIN hanghoa
        // ON hanghoa.id = chitietdathang.id_HH
        // WHERE month(dathang.NgayDH) = 1 AND year(dathang.NgayDH) = 2021

        $chitiet  = DB::table('chitietdathang')->select('*')
        // ->where('month(NgayDH)', $request->thang)
        // ->where('year(NgayDH)', 2021)
        ->join('hanghoa', 'hanghoa.id', 'chitietdathang.id_HH')
        ->join('dathang', 'dathang.id', 'chitietdathang.id_DH')
        //->where('NgayDH', '2021-02-04 17:00:38')
        ->whereMonth('NgayDH', '=', $request->thang)
         ->whereYear('NgayDH', '=', 2021)
         ->where('GiaDatHang', '<>' , 0)
         ->where('TrangThai' , '=', 'HoanThanh')
        ->get()
        ;
        return Response()->json($chitiet);
    } 
}

