<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Member;
use DB;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    //Them member
    public function getThem(){
    	$member = Member::all();
    	return view('admin.quanlymember.them',compact('member'));
    }
    public function postThem(Request $req){ //requese nhận dữ liệu từ form
        $this->validate($req,              //Kiểm tra lỗi
            [
                'name' => 'required|min:2|max:100',   //Kiểm tra tên có rỗng không ít nhất 2 kí tự nhiều nhất 100
                'email' => 'required|unique:member,email',
                'phone' => 'required|unique:member,phone',
                'address' => 'required',
                'password' => 'required',
            ]
            ,
            [
                'name.required' => 'Bạn chưa nhập Name',
                'email.required' => 'Bạn chưa nhập Email',
                'email.unique' => 'Email đã tồn tại',
                'phone.required' => 'Bạn chưa nhập Phone',
                'phone.unique' => 'Phone đã tồn tại',
                'address.required' => 'Bạn chưa nhập Address',
                'password.required' => 'Bạn chưa nhập Password',
            ]);
        $req->merge(['password'=>bcrypt($req->password)]);
        $reg = Member::create($req->all());
        if($reg){
            return redirect()->back()->with('thongbao-them','Đăng kí thành công');
        }
        return redirect()->back()->with('error','Đăng kí thất bại');
    //    dd($req->all());
   //  	$member = new Member;
   //  	$member->username = $request->username;
   //  	$member->email = $request->email;
   //  	$member->password = Hash::make($request->password);
 		// $member->save();
 		// return redirect('admin/quanlymember/them')->with('thongbao-them','Thêm thành công');
    }

    public function getSua($id){
        $memberAll = DB::table('member')->get();
        $member = DB::table('member')->where('id',$id)->get();
        return view('admin.quanlymember.sua',['memberAll'=>$memberAll],['member'=>$member]);
    }

     public function postSua(Request $req, $id){
        $member = DB::table('member')
        ->where('id',$id)
        ->update(['name' => $req->name, 'email' => $req->email, 'phone' => $req->phone, 'address' => $req->address]);
        return redirect('admin/quanlymember/sua/'.$id)->with('thongbao-sua','Sửa thành công');
    }

    public function getXoa($id){
        $member = Member::where('id',$id);
        $member->delete();
        $max = DB::table('member')->max('id') + 1;
        DB::statement("ALTER TABLE member AUTO_INCREMENT =  $max");
        return redirect('admin/quanlymember/them')->with('thongbao-xoa','Xóa thành công');
    }
}
