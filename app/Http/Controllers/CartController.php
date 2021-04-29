<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\NhomHangHoa;
use App\Models\DanhMuc;
use App\Models\HangHoa;
use App\Models\DatHang;
use App\Models\ChiTietDatHang;
use App\Models\KhachHang;
use App\Cart;
use Illuminate\Support\Arr;
use DB;
use Session;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //khai báo
    function __construct(){
    	$danhmuc = DanhMuc::all();	
    	view()->share('danhmuc',$danhmuc);
    	$nhomhanghoa = NhomHangHoa::all();
    	view()->share('nhomhanghoa',$nhomhanghoa);		
	}


	//Thêm 1 sản phẩm vào giỏ hàng or tăng số lượng sản phẩm
	public function addCart(Request $request, $id){
		$hanghoa = hanghoa::where('id',$id)->first();
		if($hanghoa != null){
			$oldCart = Session('cart') ? Session('cart') : null; //if else  3 ngôi
			$newCart = new Cart($oldCart); //truyền giỏ hàng mới từ lớp cart.php
			$newCart->addCart($hanghoa, $id); // gọi hàm addcart bên cart.php
			$request->session()->put('cart', $newCart);

			// dd($newCart);
		}
		return redirect('/ListCart');
		//return view('nguoidung.ajax.cartAJ');
	}

	public function addCartAJ(Request $request, $id){
		$hanghoa = hanghoa::where('id',$id)->first();
		if($hanghoa != null){
			$oldCart = Session('cart') ? Session('cart') : null; //if else  3 ngôi
			$newCart = new Cart($oldCart); //truyền giỏ hàng mới từ lớp cart.php
			$newCart->addCart($hanghoa, $id); // gọi hàm addcart bên cart.php
			$request->session()->put('cart', $newCart);

			// dd($newCart);
		}
		// return redirect('/ListCart');
		return view('nguoidung.ajax.cartAJ');
	}

	//Trừ số lượng sản phẩm trong giỏ hàng
	public function minusCart(Request $request, $id){
		$hanghoa = hanghoa::where('id',$id)->first();
		if($hanghoa != null){
			$oldCart = Session('cart') ? Session('cart') : null; //if else  3 ngôi
			$newCart = new Cart($oldCart); //truyền giỏ hàng mới từ lớp cart.php
			$newCart->minusCart($hanghoa, $id); //gọi hàm 
			$request->session()->put('cart', $newCart);

			// dd($newCart);
		}
		return redirect('/ListCart');
	}


	//Xóa 1 sản phẩm trong giỏ hàng
	public function deleteItemCart(Request $request, $id){
		$oldCart = Session('cart') ? Session('cart') : null; //if else  3 ngôi
		$newCart = new Cart($oldCart); //truyền giỏ hàng mới từ lớp cart.php
		$newCart->deleteItemCart($id); //gọi hàm deleteItemCart bên cart.php
		if(count($newCart->products) > 0){
			$request->Session()->put('cart', $newCart);
		}else{
			$request->Session()->forget('cart');
		}

		// dd($newCart);
		return redirect('/ListCart');
		//return view('nguoidung.ajax.cartAJ');
	}

	//Xỏa sản phẩm ajax
	public function deleteItemCartAJ(Request $request, $id){
		$oldCart = Session('cart') ? Session('cart') : null; //if else  3 ngôi
		$newCart = new Cart($oldCart); //truyền giỏ hàng mới từ lớp cart.php
		$newCart->deleteItemCart($id); //gọi hàm deleteItemCart bên cart.php
		if(count($newCart->products) > 0){
			$request->Session()->put('cart', $newCart);
		}else{
			$request->Session()->forget('cart');
		}

		// dd($newCart);
		return view('nguoidung.ajax.cartAJ');

	}

	//Hiển thị giỏ hàng
	public function ListCart(){
		
			return view('nguoidung.pages.cart');

	}


	//Thanh toán giỏ hàng và lưu vào csdl
	public function postThanhtoan(Request $request){
		$cart = Session::get('cart');
		 //dd($cart);
		if(Session::has("cart") != null){
			//Thanh toán khi đăng nhập
			if(Auth::guard('kh')->check()){
				$dathang = new DatHang;
		 		$dathang->ID_KH = Auth::guard('kh')->user()->id;
		 		$dathang->NgayDH = date('Y-m-d G:i:s');
		 		$dathang->TongSoLuong = $cart->totalSoluong;
		 		$dathang->TongTien = $cart->totalPrice;
		 		$dathang->TrangThai = 'ChuaXem';
		 		$dathang->save();
		 		//dd($dathang);

		 		foreach ($cart->products as $key => $value) {
					$hanghoa = HangHoa::all()->where('id',$key);
					$chitietdathang = new ChiTietDatHang;
			 		$chitietdathang->id_DH = $dathang->id;
			 		$chitietdathang->id_HH = $key;
			 		$chitietdathang->SoLuong = $value['soluong'];
			 		$chitietdathang->GiaDatHang = $value['gia'];
			 		$chitietdathang->save();
			 		//dem soluonghang co trong san pham
					foreach($hanghoa as $dem){
						//echo($dem->SoLuongHang);
						$update_hanghoa = DB::table('hanghoa')
						->where('id',$key)
						->update(['SoLuongHang' => $dem->SoLuongHang-$value['soluong']]);
					}
				}
		 		Session::forget('cart');	
			}
			//Thanh toán khi không đăng nhập
			else{
		     	$khachhang = new KhachHang;
		     	$khachhang->HoTenKH = $request->HoTenKH;
		     	$khachhang->DiaChi = $request->DiaChi;
		     	$khachhang->SoDienThoai = $request->SoDienThoai;
		 		$khachhang->save();
		 		//dd($khachhang);

		 		$dathang = new DatHang;
		 		$dathang->ID_KH = $khachhang->id;
		 		$dathang->NgayDH = date('Y-m-d G:i:s');
		 		$dathang->TongSoLuong = $cart->totalSoluong;
		 		$dathang->TongTien = $cart->totalPrice;
		 		$dathang->TrangThai = 'ChuaXem';
		 		$dathang->save();
		 		//dd($dathang);

		 		foreach ($cart->products as $key => $value) {
					$hanghoa = HangHoa::all()->where('id',$key);
					$chitietdathang = new ChiTietDatHang;
			 		$chitietdathang->id_DH = $dathang->id;
			 		$chitietdathang->id_HH = $key;
			 		$chitietdathang->SoLuong = $value['soluong'];
			 		$chitietdathang->GiaDatHang = $value['gia'];
			 		$chitietdathang->save();
			 		//dem soluonghang co trong san pham
					foreach($hanghoa as $dem){
						//echo($dem->SoLuongHang);
						$update_hanghoa = DB::table('hanghoa')
						->where('id',$key)
						->update(['SoLuongHang' => $dem->SoLuongHang-$value['soluong']]);
					}
				}

		 		// foreach ($cart->products as $key => $value) {
			 	// 	$chitietdathang = new ChiTietDatHang;
			 	// 	$chitietdathang->SoDonDH = $dathang->id;
			 	// 	$chitietdathang->MSHH = $key;
			 	// 	$chitietdathang->SoLuong = $value['soluong'];
			 	// 	$chitietdathang->GiaDatHang = $value['gia'];
			 	// 	$chitietdathang->save();
			 	// 	// dd($chitietdathang);

			 	// 	$hanghoa = DB::table('hanghoa')
			 	// 	->where('MSHH',$key)
			 	// 	->update([''])
		 		Session::forget('cart');
		 	}
			return redirect('/ListCart')->with('thongbao-thanhcong','Đặt hàng thành công');
		} else{
			return redirect('/ListCart')->with('thongbao-cartNull','Giỏ hàng rỗng');
		}
 		// dd($request);
	
    }

}
