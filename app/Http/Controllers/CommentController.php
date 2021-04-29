<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChiTietDatHang;
use App\Models\Comment;
use Illuminate\Support\Facades\Redirect;
use DB;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //
    function getThem(){
    	$comment = Comment::all();
    	return view('admin.quanlycomment.them',compact('comment'));
    }
    function getXoa($ID){
    	$comment = Comment::where('ID',$ID);
    	$comment->delete();
        $max = DB::table('comment')->max('ID') + 1;
        DB::statement("ALTER TABLE comment AUTO_INCREMENT =  $max");
    	return redirect('admin/quanlycomment/them')->with('thongbao-xoa','Xóa thành công');
    }
}
