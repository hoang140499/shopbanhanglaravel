<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use DB;
use App\Models\HangHoa;
use App\Models\NhomHangHoa;
use App\Models\DanhMuc;
use App\Models\Comment;
use App\Models\YeuThich;
use App\Models\ChiTietDatHang;
use App\Models\ThuocTinh;
use App\Models\GiaTriThuocTinh;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
	//Khai báo các biến sử dụng suốt quá trình không cần gọi lại
	//view->share: tất cả các view đều có biến ('danhmuc') này
	function __construct(){
    	$danhmuc = DanhMuc::all();	
    	view()->share('danhmuc',$danhmuc);
    	$nhomhanghoa = NhomHangHoa::all();
    	view()->share('nhomhanghoa',$nhomhanghoa);		
	}

    function trangchu(){
    	$hanghoa =HangHoa::all();   
    	return view('nguoidung.pages.trangchu',['hanghoa'=>$hanghoa]);
    } 

    function getLogin(){
       return view('nguoidung.pages.formDangnhap');
    } 

    function getRegisterPages(){
       return view('nguoidung.pages.formDangki');
    } 

    // <------------------------------------------------------------------------>
    function diachi(){
        return view('nguoidung.pages.diachi');
    }

    //Hiển thị các sản phẩm của danh mục bằng INNER JOIN
    function danhmuc($id){
        $danhmucc = DanhMuc::where('id',$id)->get();
        $hanghoa = DB::table('HangHoa')
        ->join('NhomHangHoa','HangHoa.id_NHH','NhomHangHoa.id')
        ->join('DanhMuc','NhomHangHoa.id_DM','DanhMuc.id')
        ->where('DanhMuc.id',$id)
        ->select('HangHoa.*')
        ->paginate(4);
    	return view('nguoidung.pages.danhmuc',['danhmucc'=>$danhmucc],['hanghoa'=>$hanghoa]);
    }
    //Sort từ cao đến thấp
    function sortDescDm($id){
         $danhmucc = DanhMuc::where('id',$id)->get();
         $hanghoa = DB::table('HangHoa')
        ->join('NhomHangHoa','HangHoa.id_NHH','NhomHangHoa.id')
        ->join('DanhMuc','NhomHangHoa.id_DM','DanhMuc.id')
        ->where('DanhMuc.id',$id)
        ->select('HangHoa.*')
        ->orderBy('Gia', 'desc')
        ->paginate(4);
         return view('nguoidung.pages.danhmuc',['danhmucc'=>$danhmucc],['hanghoa'=>$hanghoa]);
    }
    //Sort từ thấp đến cao
    function sortAscDm($id){
         $danhmucc = DanhMuc::where('id',$id)->get();
         $hanghoa = DB::table('HangHoa')
        ->join('NhomHangHoa','HangHoa.id_NHH','NhomHangHoa.id')
        ->join('DanhMuc','NhomHangHoa.id_DM','DanhMuc.id')
        ->where('DanhMuc.id',$id)
        ->select('HangHoa.*')
        ->orderBy('Gia', 'asc')
        ->paginate(4);
         return view('nguoidung.pages.danhmuc',['danhmucc'=>$danhmucc],['hanghoa'=>$hanghoa]);
    }



    // <---------------------------------------------------------------------------->


    //Hiển thị các sản phẩm của loại sản phẩm
    function loaisanpham($id){
        $nhomhanghoaa = NhomHangHoa::        
        where('NhomHangHoa.id',$id)
        ->get();
    	// $nhomhanghoaa = NhomHangHoa::where('MaNhom',$MaNhom)->get();
    	$hanghoa = HangHoa::where('id_NHH',$id)->paginate(4);
    	return view('nguoidung.pages.loaisanpham',['nhomhanghoaa'=>$nhomhanghoaa], ['hanghoa'=>$hanghoa]);
    }
    //Sort từ cao đến thấp
    function sortDescNhh($id){
    	$nhomhanghoaa = NhomHangHoa::where('id',$id)->get();
    	$hanghoa = HangHoa::where('id_NHH',$id)->orderBy('Gia', 'desc')->paginate(4);
    	return view('nguoidung.pages.loaisanpham',['nhomhanghoaa'=>$nhomhanghoaa], ['hanghoa'=>$hanghoa]);
    }

    //Sort từ thấp đến cao
    function sortAscNhh($id){
    	$nhomhanghoaa = NhomHangHoa::where('id',$id)->get();
    	$hanghoa = HangHoa::where('id_NHH',$id)->orderBy('Gia', 'asc')->paginate(4);
    	return view('nguoidung.pages.loaisanpham',['nhomhanghoaa'=>$nhomhanghoaa], ['hanghoa'=>$hanghoa]);
    }
    // <--------------------------------------------------------------------------->



    //Hiển thị thông tin 1 sản phẩm
    function sanpham($id){
        $id = $id;
        $hanghoa_all = HangHoa::groupBy('id_gtri_thuoc_tinh_1')->orderBy('id','asc')->get();
        $hanghoa_all_1 = HangHoa::all()->where('SoLuongHang', '>', 0);
        $hanghoa = HangHoa::where('HangHoa.id',$id)
        // ->join('NhomHangHoa','HangHoa.id_NHH','NhomHangHoa.id')
        // ->join('DanhMuc','NhomHangHoa.id_DM','DanhMuc.id')
        ->first(); //Lấy 1 giá trị không cần dùng foreach bên sanpham

        $sp_tuongtu = HangHoa::where('id_NHH',$hanghoa->id_NHH)
        ->where('id','<>',$id)
        ->paginate(4);

        $hinhminhhoa = HangHoa::where('id',$id)
        // ->join('NhomHangHoa','HangHoa.id_NHH','NhomHangHoa.id')
        // ->join('DanhMuc','NhomHangHoa.id_DM','DanhMuc.id')
        ->get(); 

        $comment = Comment::where('id_HH',$id)
        ->orderBy('id', 'asc')
        ->get();

        $chitietdathang = ChiTietDatHang::where('id_HH',$id)
        ->get();

        if(Auth::guard('kh')->check()){
            $id_KH = Auth::guard('kh')->user()->id;
            $yeuthich = YeuThich::where('id_HH',$id)
            ->where('id_KH',$id_KH)
            ->first();
        }else{
            $yeuthich = YeuThich::where('id_HH',$id)
            ->first();
        }
        $count_like = YeuThich::selectRaw('count(id) as count')
        ->where('id_HH', $id)
        ->where('liked', 1)
        ->first();
        return view('nguoidung.pages.sanpham1',['hanghoa'=>$hanghoa],['sp_tuongtu'=>$sp_tuongtu])->with('hinhminhhoa',$hinhminhhoa)
        ->with('comment',$comment)
        ->with('chitietdathang',$chitietdathang)
        ->with('yeuthich',$yeuthich)
        ->with('count_like',$count_like)
        ->with('hanghoa_all',$hanghoa_all)
        ->with('hanghoa_all_1',$hanghoa_all_1)
        ->with('id', $id);
    }

    function sanphamAJ($id){
        $hanghoa = HangHoa::where('id',$id)
        ->with('nhomhanghoa')
        ->with('gia_tri_thuoc_tinh_1')
        ->with('gia_tri_thuoc_tinh_2')
        ->first();
        $size = HangHoa::where('SoLuongHang', '>', 0)
        ->where('TenHH', $hanghoa->TenHH)
        ->where('id_gtri_thuoc_tinh_1', $hanghoa->id_gtri_thuoc_tinh_1)
        ->with('gia_tri_thuoc_tinh_1')
        ->with('gia_tri_thuoc_tinh_2')
        ->get();
        $comment = Comment::where('id_HH',$id)
        ->with('khachhang')
        ->orderBy('id', 'asc')
        ->get(); 
        $count_like = YeuThich::selectRaw('count(id) as count')
        ->where('id_HH', $id)
        ->where('liked', 1)
        ->first();  
        $like = YeuThich::where('id_HH',$id)    
        ->where('id_KH',Auth::guard('kh')->user()->id)
        ->first();
        return Response()->json([$hanghoa, $size, $comment, $count_like, $like]);
    }

    function sanphamAJ_Comment($id){
        $hanghoa = HangHoa::where('id',$id)
        ->with('nhomhanghoa')
        ->with('gia_tri_thuoc_tinh_1')
        ->with('gia_tri_thuoc_tinh_2')
        ->first();
        $size = HangHoa::where('SoLuongHang', '>', 0)
        ->where('TenHH', $hanghoa->TenHH)
        ->where('id_gtri_thuoc_tinh_1', $hanghoa->id_gtri_thuoc_tinh_1)
        ->with('gia_tri_thuoc_tinh_1')
        ->with('gia_tri_thuoc_tinh_2')
        ->get();
        $comment = Comment::where('id_HH',$id)
        ->with('khachhang')
        ->orderBy('id', 'asc')
        ->get();  
         $count_like = YeuThich::selectRaw('count(id) as count')
        ->where('id_HH', $id)
        ->where('liked', 1)
        ->first();      
        $like = YeuThich::where('id_HH',$id)    
        ->where('id_KH',Auth::guard('kh')->user()->id)
        ->first();  
        return Response()->json([$hanghoa, $size, $comment, $count_like, $like]);
    }

    //Tìm kiếm sản phẩm theo tên và theo giá
    function getSearch(Request $req){
        $text = $req->searchtext;
        $hanghoa = HangHoa::where('TenHH','like','%'.$req->searchtext.'%')
        ->orwhere('Gia',$req->searchtext)
        ->get();
        $link = url()->current();
        return view('nguoidung.pages.search',compact('hanghoa','text'),compact('link','link'),compact('text','text'));
    }
    //tăng dần
    function sortAscSearch(Request $req, $text){
        $hanghoa = HangHoa::where('TenHH','like','%'.$text.'%')
        ->orwhere('Gia',$text)
        ->orderBy('Gia','asc')
        ->get();
        return view('nguoidung.pages.search',compact('hanghoa'),compact('text','text'));
    }
    //giảm dần
    function sortDescSearch(Request $req, $text){
        $hanghoa = HangHoa::where('TenHH','like','%'.$text.'%')
        ->orwhere('Gia',$text)
        ->orderBy('Gia','desc')
        ->get();
        return view('nguoidung.pages.search',compact('hanghoa'),compact('text','text'));
    }

    public function postComment(Request $req, $id){
        if(Auth::guard('kh')->check()){
            if(ChiTietDatHang::where('id_HH', $id )->exists()){

                $comment = new Comment;
                $comment->id_HH = $id;
                $comment->NoiDung = $req->NoiDung;
                $comment->ID_KH = Auth::guard('kh')->user()->id;
                $comment->save();
                // dd($MSHH);
                return redirect()->back();

            }else{
                 return redirect()->back()->with('thongbao-them','Vui lòng đặt mua sản phẩm trước khi comment');
            }
        }else{
            $comment = new Comment;
            $comment->id_KH = $id_KH;
            $comment->NoiDung = $req->NoiDung;
            $comment->save();
            // dd($MSHH);
            return redirect()->back();          
        }
    }

}
