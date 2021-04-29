<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DanhmucAjaxController;
use App\Http\Controllers\NhomhanghoaAjaxController;
use App\Http\Controllers\ThongkeAjaxController;
use App\Http\Controllers\DonhangAjaxController;
use App\Http\Controllers\CommentAjaxController;
use App\Http\Controllers\MemberAjaxController;
use App\Http\Controllers\HanghoaAjaxController;
use App\Http\Controllers\BieudoAjaxController;
use App\Http\Controllers\KhachhangAjaxController;
use App\Http\Controllers\AccountAjaxController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//-----------------------------------TRANG DÀNH CHO ADMIN-----------------------------------
// Đăng nhập đăng xuất admin
	Route::get('admin/login','App\Http\Controllers\AuthController@getLogin')->name('login');
	Route::post('admin/login','App\Http\Controllers\AuthController@postLogin')->name('login');
	Route::get('register','App\Http\Controllers\AuthController@getRegister')->name('register');
	Route::post('register','App\Http\Controllers\AuthController@postRegister')->name('register');
	// Route::get('thanhcong','App\Http\Controllers\AuthController@thanhcong')->middleware('auth')->name('thanhcong');
	Route::get('logout','App\Http\Controllers\AuthController@logout')->name('logout');
// End Đăng nhập đăng xuất admin

//Quản lý admin-crud
Route::group(['prefix' => 'admin-crud', 'middleware' => 'member'],function(){
	Route::get('trangchu',[DanhmucAjaxController::class, 'trangchu'])->name('trangchuCrud');
	//Danh mục
	Route::get('danhmuc',[DanhmucAjaxController::class, 'danhmuc'])->name('danhmucCrud');
	Route::post('store-danhmuc', [DanhmucAjaxController::class, 'storeDanhmuc']);
	Route::post('edit-danhmuc', [DanhmucAjaxController::class, 'editDanhmuc']);
	Route::post('delete-danhmuc', [DanhmucAjaxController::class, 'deleteDanhmuc']);

	//Nhóm hàng hóa
	Route::get('nhomhanghoa',[NhomhanghoaAjaxController::class, 'nhomhanghoa'])->name('nhomhanghoaCrud');
	Route::post('store-nhomhanghoa', [NhomhanghoaAjaxController::class, 'storeNhomhanghoa']);
	Route::post('edit-nhomhanghoa', [NhomhanghoaAjaxController::class, 'editNhomhanghoa']);
	Route::post('delete-nhomhanghoa', [NhomhanghoaAjaxController::class, 'deleteNhomhanghoa']);

	
	//Thống kê
	Route::get('thongke',[ThongkeAjaxController::class, 'thongke'])->name('thongkeCrud');
	Route::post('detail-thongke',[ThongkeAjaxController::class, 'detailThongke'])->name('detailThongkeCrud');

	//Biểu đồ
	Route::get('bieudo',[BieudoAjaxController::class, 'bieudo'])->name('bieudoCrud');


	//Đơn hàng
	Route::get('donhang',[DonhangAjaxController::class, 'donhang'])->name('donhangCrud');
	Route::post('store-donhang',[DonhangAjaxController::class, 'storeDonhang'])->name('storeDonhangCrud');
	Route::post('edit-donhang',[DonhangAjaxController::class, 'editDonhang'])->name('editDonhangCrud');
	Route::post('detail-donhang',[DonhangAjaxController::class, 'detailDonhang'])->name('detailDonhangCrud');

	//Comment
	Route::get('comment',[CommentAjaxController::class, 'comment'])->name('commentCrud');

	//Khách hàng
	Route::get('khachhang',[KhachhangAjaxController::class, 'khachhang'])->name('khachhangCrud');

	//Member
	Route::get('member',[MemberAjaxController::class, 'member'])->name('memberCrud');

	//Hàng hóa
	Route::get('hanghoa',[HanghoaAjaxController::class, 'hanghoa'])->name('hanghoaCrud');
	Route::post('store-hanghoa',[HanghoaAjaxController::class, 'storeHanghoa'])->name('storeHanghoaCrud');

	Route::post('edit-hanghoa',[HanghoaAjaxController::class, 'editHanghoa'])->name('editHanghoaCrud');
	
	Route::post('delete-hanghoa',[HanghoaAjaxController::class, 'deleteHanghoa'])->name('deleteHanghoaCrud');

	//Account
	Route::get('thongtin',[AccountAjaxController::class, 'thongtin']);
	Route::post('thongtin',[AccountAjaxController::class, 'postThongtin']);

	Route::get('chgpass',[AccountAjaxController::class, 'chgpass']);
	Route::post('chgpass',[AccountAjaxController::class, 'postChgpass']);

	Route::get('hoatdong',[AccountAjaxController::class, 'hoatdong']);
});	
//Quản lý 	
Route::group(['prefix' => 'admin', 'middleware' => 'member'],function(){
	Route::get('trang-chu','App\Http\Controllers\DanhmucController@getTrangchu')->name('trang-chu');
	// Quản lý Member
	Route::group(['prefix'=>'quanlymember'],function(){
		// admin/quanlymember/them
		Route::get('them','App\Http\Controllers\MemberController@getThem');
		Route::post('them','App\Http\Controllers\MemberController@postThem');
		// admin/quanlymember/sua/MaDanhMuc
		Route::get('sua/{id}','App\Http\Controllers\MemberController@getSua');
		Route::post('sua/{id}','App\Http\Controllers\MemberController@postSua');
		//admin/quanlymember/xoa/MaDanhMuc
		Route::get('xoa/{id}','App\Http\Controllers\MemberController@getXoa');
	});
	//<------------------------End Quản lý Member------------------------------->

	// Quản lý danh mục
	Route::group(['prefix'=>'quanlydanhmuc'],function(){
		// admin/quanlydanhmuc/them
		Route::get('them','App\Http\Controllers\DanhmucController@getThem');
		Route::post('them','App\Http\Controllers\DanhmucController@postThem');
		// admin/quanlydanhmuc/sua/MaDanhMuc
		Route::get('sua/{MaDanhMuc}','App\Http\Controllers\DanhmucController@getSua');
		Route::post('sua/{MaDanhMuc}','App\Http\Controllers\DanhmucController@postSua');
		//admin/quanlydanhmuc/xoa/MaDanhMuc
		Route::get('xoa/{MaDanhMuc}','App\Http\Controllers\DanhmucController@getXoa');
	});
	//<---------------------------End Quản lý danh mục----------------------------------------->


	//Quản lý nhóm hàng hóa
	Route::group(['prefix' => 'quanlynhomhanghoa'],function(){
		// admin/quanlynhomhanghoa/them
		Route::get('them','App\Http\Controllers\NhomhanghoaController@getThem');
		Route::post('them','App\Http\Controllers\NhomhanghoaController@postThem');
		// admin/quanlynhomhanghoa/sua/MaNhom
		Route::get('sua/{MaNhom}','App\Http\Controllers\NhomhanghoaController@getSua');
		Route::post('sua/{MaNhom}','App\Http\Controllers\NhomhanghoaController@postSua');
		// admin/quanlynhomhnghoa/xoa/MaNhom
		Route::get('xoa/{MaNhom}','App\Http\Controllers\Nhomhanghoacontroller@getXoa');
	});
	//<-------------------------End Quản lý nhóm hàng hóa----------------------------------->


	//Quản lý hàng hóa
	Route::group(['prefix' => 'quanlyhanghoa'],function(){
		// admin/quanlyhanghoa/them
		Route::get('them','App\Http\Controllers\HanghoaController@getThem');
		Route::post('them','App\Http\Controllers\HanghoaController@postThem');
		// admin/quanlyhanghoa/sua/MSHH
		Route::get('sua/{MSHH}','App\Http\Controllers\HanghoaController@getSua');
		Route::post('sua/{MSHH}','App\Http\Controllers\HanghoaController@postSua');
		// admin/quanlyhanghoa/xoa/MSHH
		Route::get('xoa/{MSHH}','App\Http\Controllers\Hanghoacontroller@getXoa');
	});
	//<--------------------------End Quản lý hàng hóa--------------------------------->
	
	//Quản lý chi tiết đặt hàng
	Route::group(['prefix' => 'quanlychitietdathang'],function(){
		// admin/quanlychitietdathang/them
		Route::get('them','App\Http\Controllers\ChitietdathangController@getThem');
	});
	//<-----------------------End Quản lý chi tiết đặt hàng-------------------------->

	//Quản lý đặt hàng
	Route::group(['prefix' => 'quanlydathang'],function(){
		// admin/quanlydathang/them
		Route::get('them','App\Http\Controllers\DathangController@getThem');
		Route::get('sua/{SoDonDH}','App\Http\Controllers\DathangController@getSua');
		Route::post('sua/{SoDonDH}','App\Http\Controllers\DathangController@postSua');
		// Route::get('xoa/{SoDonDH}','App\Http\Controllers\DathangController@getXoa');
	});
	//<-----------------------End Quản lý đặt hàng-------------------------->

	//Quản lý khách hàng
	Route::group(['prefix' => 'quanlykhachhang'],function(){
		// admin/quanlykhachhang/them
		Route::get('them','App\Http\Controllers\KhachhangController@getThem');
		// admin/quanlykhachhang/xoa
		Route::get('xoa/{MSKH}','App\Http\Controllers\KhachhangController@getXoa');
		// admin/quanlykhachhang/sua
		Route::get('sua/{MSKH}','App\Http\Controllers\KhachhangController@getSua');
		Route::post('sua/{MSKH}','App\Http\Controllers\KhachhangController@postSua');
	});
	//<----------------------------End Quản lý khách hàng--------------------------->



	//Quản lý nhân viên
	Route::group(['prefix' => 'quanlynhanvien'],function(){
		// admin/quanlynhanvien/them
		Route::get('them','App\Http\Controllers\NhanvienController@getThem');
		Route::post('them','App\Http\Controllers\NhanvienController@postThem');
		// admin/quanlynhanvien/sua/{MSNV}
		Route::get('sua/{MSNV}','App\Http\Controllers\NhanvienController@getSua');
		Route::post('sua/{MSNV}','App\Http\Controllers\NhanvienController@postSua');
		// admin/quanlynhanvien/sua/{MSNV}
		Route::get('xoa/{MSNV}','App\Http\Controllers\NhanvienController@getXoa');
	});
	Route::group(['prefix' => 'quanlycomment'],function(){
		// admin/quanlynhanvien/them
		Route::get('them','App\Http\Controllers\CommentController@getThem');
		// admin/quanlynhanvien/xoa/{ID}
		Route::get('xoa/{ID}','App\Http\Controllers\CommentController@getXoa');
	});
	//<----------------------------End Quản lý nhân viên-------------------------->
});	
//<--------------------------------END TRANG QUẢN LÝ ADMIN------------------------------------>



//<--------------------------------TRANG PAGES NGƯỜI DÙNG----------------------------------->
// trangchu
	Route::get('trangchu','App\Http\Controllers\PagesController@trangchu')->name('trangchu');
// <--------------------------------------------------------------->
// Đăng nhập
	Route::get('loginPages','App\Http\Controllers\PagesController@getLogin')->name('loginPages');
	Route::post('loginPages','App\Http\Controllers\AuthController@postLoginPages')->name('loginPages');
// Đăng ký
	Route::get('registerPages','App\Http\Controllers\PagesController@getRegisterPages')->name('registerPages');
	Route::post('registerPages','App\Http\Controllers\AuthController@postRegisterPages')->name('postRegisterPages');
// Đăng xuất
	Route::get('logoutPages','App\Http\Controllers\AuthController@logoutPages')->name('logoutPages');

//Địa chỉ
	Route::get('diachi','App\Http\Controllers\PagesController@diachi');
// <--------------------------------------------------------------->

// danhmuc/{MaDanhMuc} (Hiển thị sản phẩm có trong danh mục)
	Route::get('danhmuc/{id}','App\Http\Controllers\PagesController@danhmuc');
	Route::get('danhmuc/{id}/sort-desc','App\Http\Controllers\PagesController@sortDescDm');
	Route::get('danhmuc/{id}/sort-asc','App\Http\Controllers\PagesController@sortAscDm');
// <--------------------------------------------------------------->

// loaisanpham/{MaNhom} (Hiển sản phẩm của 1 loại sản phẩm)
	Route::get('loaisanpham/{id}','App\Http\Controllers\PagesController@loaisanpham');
	Route::get('loaisanpham/{id}/sort-desc','App\Http\Controllers\PagesController@sortDescNhh');
	Route::get('loaisanpham/{id}/sort-asc','App\Http\Controllers\PagesController@sortAscNhh');

// sanpham/{MSHH} (Hiển thị thông tin của 1 sản phẩm)
	Route::get('sanpham/{id}','App\Http\Controllers\PagesController@sanpham');

//sanphamAJ/{MSHH} dùng ajax để thay đổi thông tin sản phẩm khi chọn
	Route::get('sanphamAJ/{id}','App\Http\Controllers\PagesController@sanphamAJ');

//sanphamAJ/{MSHH} dùng ajax để thay đổi thông tin sản phẩm khi chọn
	Route::get('sanphamAJ_Comment/{id}','App\Http\Controllers\PagesController@sanphamAJ_Comment');

// Route::get('pages','App\Http\Controllers\PagesController@pages');

//Tìm sản phẩm
	Route::get('/Search','App\Http\Controllers\PagesController@getSearch');
	Route::get('/Search/{text}/sort-asc','App\Http\Controllers\PagesController@sortAscSearch');
	Route::get('/Search/{text}/sort-desc','App\Http\Controllers\PagesController@sortDescSearch');
	//Quản lý giỏ hàng
	//Thêm
	Route::get('/AddCart/{id}','App\Http\Controllers\CartController@addCart');
	//Thêm Ajax
	Route::get('/AddCartAJ/{id}','App\Http\Controllers\CartController@addCartAJ');

	//Trừ
	Route::get('/MinusCart/{id}','App\Http\Controllers\CartController@minusCart');

	//Xóa sp
	Route::get('/Delete-Item-Cart/{id}','App\Http\Controllers\CartController@deleteItemCart');
	//Xóa sp ajax
	Route::get('/Delete-Item-CartAJ/{id}','App\Http\Controllers\CartController@deleteItemCartAJ');
	//Thanhtoan
	Route::post('/ThanhToan','App\Http\Controllers\CartController@postThanhtoan');
	//Hiển thị giỏ hàng
	Route::get('/ListCart','App\Http\Controllers\CartController@ListCart');

//ajax

//Comment
	Route::post('/Comment/{id}','App\Http\Controllers\PagesController@postComment');
//Account

//Sau này sẽ dùng: tạo middle khác member
//Các trang dành cho middleware
	Route::group(['middleware' => 'khachhang'],function(){

		Route::post('/likeProduct/{id}','App\Http\Controllers\QuanlyACController@postLikeProduct')->name('postLikeProduct');
		Route::post('/unlikeProduct/{id}','App\Http\Controllers\QuanlyACController@postUnLikeProduct')->name('postUnLikeProduct');

		Route::group(['prefix'=>'account'],function(){	
		//thông tin
		Route::get('/profile','App\Http\Controllers\QuanlyACController@getAccountProfile')->name('getAccountProfile');
		Route::post('/profile','App\Http\Controllers\QuanlyACController@postAccountProfile')->name('getAccountProfile');

		//hóa đơn
		Route::get('/listOrder','App\Http\Controllers\QuanlyACController@getAccountListOrder')->name('getAccountListOrder');

		//sp yêu thích
		Route::get('/likeProduct','App\Http\Controllers\QuanlyACController@getAccountLikeProduct')->name('getAccountLikeProduct');
		
		
		//password
		Route::get('/changePass','App\Http\Controllers\QuanlyACController@getChangePass')->name('getChangePass');

		Route::post('/changePass','App\Http\Controllers\QuanlyACController@postChangePass')->name('postChangePass');

		//comment
		Route::get('/comment','App\Http\Controllers\QuanlyACController@getComment')->name('getComment');
		// Route::post/{id}('/comment','App\Http\Controllers\QuanlyACController@postComment')->name('postComment');
		// Route::post('/ajaxRequest','App\Http\Controllers\QuanlyACController@postComment')->name('ajaxRequestPost');
	});
});

Route::get('ajax', 'App\Http\Controllers\QuanlyACController@getAjax');
Route::post('ajax', 'App\Http\Controllers\QuanlyACController@postAjax');


//Route::get('likeAjax/{id}', 'App\Http\Controllers\PagesController@sanphamAJ');
Route::post('unlikeAjax', 'App\Http\Controllers\QuanlyACController@postUnLikeAjax');
//Route::post('likeAjax', 'App\Http\Controllers\QuanlyACController@postLikeAjax');
	//-----------------End Các trang dành cho middleware-----------------
//<--------------------------------END TRANG PAGES NGƯỜI DÙNG----------------------------------->