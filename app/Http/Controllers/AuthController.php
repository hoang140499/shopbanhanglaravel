<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Member;
use App\Models\KhachHang;
use App\Models\Customer;

//Vào App\Models\user.php thêmprotected $table = 'Tên bảng chứa username' và thay đổi giá trị protected $fillable cho giống bảng đó;
class AuthController extends Controller
{

    //  public function __construct(){
    //     $user = Auth::user();
    // }
    //
    // public function trangchu(){
    // 	return view ('admin.layout.index');
    // }
    public function getTrangchuCrud(){
        return view('admin-crud.index');
    }

    public function getRegister(){
        return view('admin.login.formDangki');
    }

    // public function postRegister(Request $req){
    //     $req->merge(['password'=>bcrypt($req->password)]);
    //     $reg = Member::create($req->all());
    //     if($reg){
    //         return redirect()->route('login')->with('success','Đăng kí thành công');
    //     }
    //     return redirect()->back()->with('error','Đăng kí thất bại');
    //     dd($req->all());
    // }

    public function getLogin(){
    	return view('admin.login.formDangnhap');
    }
     public function thanhcong(){
    	return view ('admin.login.thanhcong');
    }
    public function postLogin(Request $req){
        // dd($req->all());
    	// $username = $req['user'];
    	// $password = $req['pass'];

    	// $member = User::where('user',$username);
    	// Auth::login($member);
    	// $array = ['username'=>$username, 'password'=>$password];
        $req->validate([
            'email' => 'required|email',
            'password' => 'required',
        ],[
            'email.required' => 'Vui lòng nhập email',
            'password.required' => 'Vui lòng nhập password',
        ]);
        $login = Auth::guard('member')->attempt($req->only('email','password'),$req->has('remember'));
    	if($login){
    		//return redirect()->intended('admin/trang-chu');
            // return redirect('admin/');
            // return view('admin.layout.index');
    		// dd($array['username'], $array['password'], 'dang nhap thanh cong');
             return redirect()->route('trangchuCrud')->with('success','Đăng nhập thành công');
            //dd (Auth::guard('member')->user());
            //return view('admin.layout.index',['user'=>Auth::user()]);
            //dd(Auth::user());
            //dd($req->only('username','password'));
    	}
    	else{
    		return back()->with('error','Đăng nhập thất bại');
    		// dd('that bai');
        }
    }


    public function logout(){
	    Auth::guard('member')->logout();
	    return redirect()->route('login');
    }

    // Người dùng>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    public function postLoginPages(Request $req){
        // dd($req->all());
        // $username = $req['user'];
        // $password = $req['pass'];

        // $member = User::where('user',$username);
        // Auth::login($member);
        // $array = ['username'=>$username, 'password'=>$password];
        $req->validate([
            'email' => 'required|email',
            'password' => 'required',
        ],[
            'email.required' => 'Vui lòng nhập email',
            'password.required' => 'Vui lòng nhập password',
        ]);
        $login = Auth::guard('kh')->attempt($req->only('email','password'),$req->has('remember'));
        if($login){
            //return redirect()->intended('admin/trang-chu');
            // return redirect('admin/');
            // return view('admin.layout.index');
            // dd($array['username'], $array['password'], 'dang nhap thanh cong');
            return redirect()->route('trangchu')->with('success','Đăng nhập thành công');
            //dd (Auth::guard('cus')->user());
            //return view('admin.layout.index',['user'=>Auth::user()]);
            //dd(Auth::user());
            //dd($req->only('username','password'));
        }
        else{
            return back()->with('error','Đăng nhập thất bại');
            // dd('that bai');
        }
    }
    public function postRegisterPages(Request $req){
       $this->validate($req,              //Kiểm tra lỗi
            [
                'name' => 'required|min:2|max:100',   //Kiểm tra tên có rỗng không ít nhất 2 kí tự nhiều nhất 100
                'email' => 'required|unique:khachhang,email',
                'phone' => 'required',
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
        // $reg = KhachHang::create($req->all());
        $khachhang = new KhachHang;
        $khachhang->HoTenKH = $req->name;
        $khachhang->email = $req->email;
        $khachhang->DiaChi = $req->address;
        $khachhang->SoDienThoai = $req->phone;
        $khachhang->password = $req->password;
        $khachhang->save();
        // dd ($khachhang);
        // if($reg){
             return redirect()->back()->with('thongbao-them','Đăng kí thành công');
        // }
        // return redirect()->back()->with('error','Đăng kí thất bại');
    //    dd($req->all());
   //   $member = new Member;
   //   $member->username = $request->username;
   //   $member->email = $request->email;
   //   $member->password = Hash::make($request->password);
        // $member->save();
        // return redirect('admin/quanlymember/them')->with('thongbao-them','Thêm thành công');
    }


    public function logoutPages(){
        Auth::guard('kh')->logout();
        return redirect()->route('trangchu');
    }
}

?>
