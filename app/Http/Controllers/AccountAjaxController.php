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
use Illuminate\Support\Facades\Hash;

class AccountAjaxController extends Controller
{
    //
    function __construct(){
        $header = DatHang::selectRaw('count(id) as count')->where('TrangThai', 'ChuaXem')->first();
        view()->share('header',$header);    
        $today = date('d-m-Y H:i:s');
         view()->share('today',$today); 
    }
    public function thongtin(){
        return view('admin-crud.content.accountThongtin');
    }

    public function postThongtin(Request $req){
        $id = Auth::guard('member')->user()->id;
        $admin = Member::where('id',$id)
        ->update(['name' => $req->name, 'phone' => $req->phone, 'address' => $req->address]);
        return redirect()->back()->with('thongbao-sua','Sửa thành công');
    }

    public function chgpass(){
        return view('admin-crud.content.accountPassword');
    }

    public function hoatdong(){
        return view('admin-crud.content.accountHoatdong');
    }

    public function postChgpass(Request $request){
        // $this->validate($request,
        //     [
        //     'old-password' => 'required',
        //     'new-password' => 'required',
        //     'retry-password' => 'required',
        // ],
        // [
        //     'old-password.required' => 'Bạn chưa nhập mật khẩu hiện tại',
        //     'new-password.required' => 'Bạn chưa nhập mật khẩu mới',
        //     'retry-password.required' => 'Bạn chưa nhập lại mật khẩu',
        // ]);
        if(!(Hash::check($request->get('old-password'), Auth::guard('member')->user()->password))){
            return back()->with('error','Mật khẩu hiện tại không trùng khớp');
        }
        if(strcmp($request->get('old-password'), $request->get('new-password')) == 0){
            return back()->with('error','Mật khẩu hiện tại và mật khẩu mới trùng nhau');
        }
        if(strcmp($request->get('new-password'), $request->get('retry-password')) != 0){
            return back()->with('error','Xác nhận mật khẩu không trùng khớp');
        }
        $user = Auth::guard('member')->user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return back()->with('thongbao-sua','Đổi mật khẩu thành công');
    }

    public function getComment(){
        $id = Auth::guard('kh')->user()->id;
        // dd ($id);
        $comment = Comment::where('ID_KH',$id)
        ->get();
        return view('nguoidung.pages.binhluanAC',compact('comment'));
    }
    public function postComment(Request $req){
            $comment = new Comment;
            $comment->MSHH = 80101;
            $comment->NoiDung = $req->NoiDung;
            $comment->save();
            // dd($MSHH);
            //return redirect()->back();      
    }


    public function getSearch(Request $req){
        $text = $req->searchtext;
        $hanghoa = HangHoa::where('TenHH','like','%'.$req->searchtext.'%')
        ->orwhere('Gia',$req->searchtext)
        ->get();
        return view('nguoidung.pages.search',compact('hanghoa','text'));
    }
}
