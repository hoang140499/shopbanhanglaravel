<?php

namespace App\Http\Controllers;
use DB;
use App\Models\HangHoa;
use App\Models\NhomHangHoa;
use App\Models\DanhMuc;
use App\Models\Comment;
use App\Models\DatHang;
use App\Models\KhachHang;
use App\Models\YeuThich;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class QuanlyACController extends Controller
{
		function __construct(){
    	$danhmuc = DanhMuc::all();	
    	view()->share('danhmuc',$danhmuc);
    	$nhomhanghoa = NhomHangHoa::all();
    	view()->share('nhomhanghoa',$nhomhanghoa);		
	}
    //Xem thông tin tài khoản
	public function getAccountProfile(){
         // if(Auth::guard('kh')->check()){
                return view('nguoidung.pages.thongtinAC');
            // }else{
            //     return redirect('/loginPages')->with('error','Vui lòng đăng nhập');
            // }
    }
    //Sửa thông tin tài khoản
    public function postAccountProfile(Request $req){
        $id = Auth::guard('kh')->user()->id;
        $admin = KhachHang::where('id',$id)
        ->update(['HoTenKH' => $req->HoTenKH, 'SoDienThoai' => $req->SoDienThoai, 'DiaChi' => $req->DiaChi]);
        return redirect()->back()->with('thongbao-sua','Sửa thành công');
    }

    //Xem danh sách đơn hàng(chua xem, xac nhan, hoan thanh)
    public function getAccountListOrder(Request $req){
			$text = $req->type;
			if($text == 1){
				$id = Auth::guard('kh')->user()->id;
				$dathang = DatHang::where('ID_KH', $id)->where('TongTien', '<>', 0)->get();
				return view('nguoidung.pages.donhangAC', compact('dathang'));
			}
            elseif($text == 2){
                $id = Auth::guard('kh')->user()->id;
                $dathang = DatHang::where('ID_KH', $id)
                ->where('TrangThai', 'ChuaXem')
                ->where('TongTien', '<>', 0)
                ->get();
                return view('nguoidung.pages.donhangAC', compact('dathang'));
            }
            elseif($text == 3){
                $id = Auth::guard('kh')->user()->id;
                $dathang = DatHang::where('ID_KH', $id)
                ->where('TrangThai', 'XacNhan')
                ->where('TongTien', '<>', 0)
                ->get();
                return view('nguoidung.pages.donhangAC', compact('dathang'));
            }
            elseif($text == 4){
                $id = Auth::guard('kh')->user()->id;
                $dathang = DatHang::where('ID_KH', $id)
                ->where('TrangThai', 'HoanThanh')
                ->where('TongTien', '<>', 0)
                ->get();
                return view('nguoidung.pages.donhangAC', compact('dathang'));
            }
			else{
				$id = Auth::guard('kh')->user()->id;
				$dathang = DatHang::where('ID_KH', $id)
                ->where('TongTien', '<>', 0)
                ->get();
				return view('nguoidung.pages.donhangAC', compact('dathang'));	
			}
    }

    //Xem sản phẩm yêu thích
    public function getAccountLikeProduct(){
        // if(Auth::guard('member')->check()){
            return view('nguoidung.pages.spyeuthichAC');
        // }else{
        //     return redirect('/loginPages')->with('error','Vui lòng đăng nhập');
        // }
    }

    //Thích sản phẩm
     public function postLikeProduct(Request $request ,$id){
        $yeuthichId =    $request->id;
        $id_KH = Auth::guard('kh')->user()->id;

        $yeuthich = YeuThich::where('id_HH',$id)
        ->where('id_KH',$id_KH)
        ->first();

        if ($yeuthich == null) {
            $yeuthich = new YeuThich;
            $yeuthich->id_HH = $id;
            $yeuthich->id_KH = $id_KH;
            $yeuthich->liked = 1;
            $yeuthich->save();
        }
        return redirect()->back();
        //return Response()->json($yeuthich);
    }

    //Bỏ Thích sản phẩm
    public function postUnLikeProduct(Request $request ,$id){
        $id_KH = Auth::guard('kh')->user()->id;   
        $yeuthich = YeuThich::where('id_HH',$id)
        ->where('id_KH',$id_KH);
        $yeuthich -> delete(); 
        $max = DB::table('yeuthich')->max('id') + 1;
        DB::statement("ALTER TABLE yeuthich AUTO_INCREMENT =  $max");                
        return redirect()->back();
        //return Response()->json($nhomhanghoa);
    }


    //Xem đổi mật khật
    public function getChangePass(){
        return view('nguoidung.pages.matkhauAC');
    }

    //Đổi mật khẩu
    public function postChangePass(Request $request){
        $this->validate($request,
            [
            'old-password' => 'required',
            'new-password' => 'required',
            'retry-password' => 'required',
        ],
        [
            'old-password.required' => 'Bạn chưa nhập mật khẩu hiện tại',
            'new-password.required' => 'Bạn chưa nhập mật khẩu mới',
            'retry-password.required' => 'Bạn chưa nhập lại mật khẩu',
        ]);
        if(!(Hash::check($request->get('old-password'), Auth::guard('kh')->user()->password))){
            return back()->with('error','Mật khẩu hiện tại không trùng khớp');
        }
        if(strcmp($request->get('old-password'), $request->get('new-password')) == 0){
            return back()->with('error','Mật khẩu hiện tại và mật khẩu mới trùng nhau');
        }
        $user = Auth::guard('kh')->user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return back()->with('success','Đổi mật khẩu thành công');
    }

    //Xem cmt
    public function getComment(){
        $id = Auth::guard('kh')->user()->id;
        // dd ($id);
        $comment = Comment::where('ID_KH',$id)
        ->get();
        return view('nguoidung.pages.binhluanAC',compact('comment'));
    }

    //Thêm cmt
    public function postComment(Request $req, $id){
            $comment = new Comment;
            $comment->MSHH = $id;
            $comment->NoiDung = $req->NoiDung;
            $comment->save();
            // dd($MSHH);
            //return redirect()->back();      
    }

    //Tìm kiếm sp

     public function getAjax()
    {

        return view('nguoidung.pages.test');
    }

     public function postAjax(Request $request)
    {
        $comment = new Comment;
        $comment->id_KH = $request->id_KH;
        $comment->id_HH = $request->id_HH;
        $comment->NoiDung = $request->NoiDung;
        $comment->save();
        return response()->json($comment);
    }

    public function postUnLikeAjax(Request $request){
        $id_HH = $request->id_HH;
        $id_KH = $request->id_KH;

        $yeuthich = YeuThich::where('id_HH',$id_HH)
        ->where('id_KH',$id_KH)
        ->first();
        if ($yeuthich == null) {
            $yeuthich = new YeuThich;
            $yeuthich->id_HH = $id_HH;
            $yeuthich->id_KH = $id_KH;
            $yeuthich->liked = 1;
            $yeuthich->save();
            return response()->json($yeuthich);
        }else{
            $yeuthich = YeuThich::where('id_HH',$id_HH)
            ->where('id_KH',$id_KH);
            $yeuthich -> delete(); 

            $max = DB::table('yeuthich')->max('id') + 1;
            DB::statement("ALTER TABLE yeuthich AUTO_INCREMENT =  $max");                
            return response()->json($yeuthich);
        }

        
        //return response()->json($request->all());
    }

    // public function postLikeAjax(Request $request){
    //     $id_HH =    $request->id_HH;
    //     $id_KH = $request->id_KH;

    //     $yeuthich = YeuThich::where('id_HH',$id_HH)
    //     ->where('id_KH',$id_KH)
    //     ->first();

    //     if ($yeuthich == null) {
    //         $yeuthich = new YeuThich;
    //         $yeuthich->id_HH = $id_HH;
    //         $yeuthich->id_KH = $id_KH;
    //         $yeuthich->liked = 1;
    //         $yeuthich->save();
    //         return response()->json($yeuthich);
    //     }
    //     //return Response()->json($yeuthich);
    // }

}
