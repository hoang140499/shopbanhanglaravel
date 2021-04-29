@extends('index')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
	.link ul a{
		font-size: 20px;
		text-decoration: none;
	}
	.ten ul{
		list-style: none;
		padding-left: 20px;
	}
	.khuyenmai ul{
		width:100%;
		background-color: #8dffaf;
		border: 2px solid #ea0c0c;
	}

	.khuyenmai ul li{
		list-style:none;
		padding: 0px 0px 0px 30px;
	}

	.mausac{
	width:100%;
	}

	.size{
		width:100%;
		padding-top:20px;
	}

	.than .product .muangay{
	width:100%;
	padding-top:20px;
}

/*Đặt mua online của sản phẩm*/
	.muangay .muangay-l{
		width:50%;
		height:5em;
		float:left;
	}

	.muangay .muangay-l button{
		width:95%;
		height:100%;
		background-color: #ea0c0c;
		padding: 0px 0px 0px 0px;
		border:0px;

	}

	.muangay .muangay-l button p{
		margin:0px 0px 2px 0px;
		color:white;
	}	
	/*End Đặt mua online của sản phẩm*/
	/*Mua tại cửa hàng của sản phẩm*/
	.muangay .muangay-r{
		width:50%;
		float:left;
		height:5em;
	}

	.muangay .muangay-r button{
		width:95%;
		height:100%;
		background-color: #000000;
		border:0px;
		float:right;
	}

	.muangay .muangay-r button p{
		margin:0px 0px 2px 0px;
		color:white;
	}

	.motasp ul {
		padding-left: 30px;
	}
	
	
</style>
<div class="product" id="product">
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" style="text-align: left">
			<div class="link">
				<ul>
					{{-- Link --}}
					<a href="{{ asset ('/trangchu')}}">Trang chủ</a>
					<span>></span>
					<a href="{{ asset ('/danhmuc/')}}/{{ $hanghoa->nhomhanghoa->danhmuc->id }}">{{ $hanghoa->nhomhanghoa->danhmuc->TenDanhMuc }}</a>
					<span>></span>
					<a href="{{ asset ('/loaisanpham/')}}/{{ $hanghoa->nhomhanghoa->id }}">{{ $hanghoa->nhomhanghoa->TenNhom }}</a>
					<span>></span>
					<span id="ten">{{ $hanghoa->TenHH }}</span>
				</ul>
			</div>	
		</div>
	</div>
	<div class="row" style="padding-bottom: 15px; border-bottom: 5px solid #f3f3f3">
		<div class="col-sm-5 col-md-5 col-lg-5 col-xl-5" style="text-align: left;">
			<div class="ten"> 
				<ul>
					<b><li style="font-size:30px;" id="tenhh">{{ $hanghoa->TenHH }}</li></b>
					<b><li style="font-size:25px; color:red" id="gia">{{ number_format($hanghoa->Gia) }}đ</li></b>
					@if(Auth::guard('kh')->check())
						@if($yeuthich && $yeuthich->liked == '1')
						<div class="countlike" id="countlike">
							<form action="javascript:void(0)" method="post" enctype="multipart/form-data">					
								<button class="btn btn-info" type="button" style="position: absolute; top: 45px; left: 380px" id="UnLikeRequest" onclick="Unliked({{ $hanghoa->id }})"> 
									<i class="far fa-thumbs-up"></i> 
									Đã thích ({{ $count_like->count }})
								</button>
							</form>
						</div>
						@else
						<div class="countlike" id="countlike">
							<form action="javascript:void(0)" method="post" enctype="multipart/form-data">					
								<button class="btn btn-info" type="button" style="position: absolute; top: 45px; left: 380px" id="LikeRequest" onclick="liked({{ $hanghoa->id }})"> 
									<i class="far fa-thumbs-up"></i> 
									Thích ({{ $count_like->count }})
								</button>
							</form>
						</div>
						@endif
					@else 
					<button class="btn btn-info" type="submit" style="position: absolute; top: 45px; left: 380px" onclick="like()"> <i class="far fa-thumbs-up"></i> Like ({{ $count_like->count }})</button>
					@endif
					
				</ul>
			</div>
			<div class="khuyenmai">
				<ul>
					<li style="	background-color:#ea0c0c; color:white; height:2em;">KHUYẾN MÃI ĐẶC BIỆT</li>
					<li>• Tặng túi rút YS cho hóa đơn từ 599.000vnd </li>  
					<li>• Tặng trống YS cho hóa đơn từ 799.000vnd </li>
					<li>• Giảm 20% tất cả phụ kiện mua kèm </li>
					<li>• Bảo hành keo trọn đời.</li>
					<li>• Đổi trả trong 30 ngày.</li>
				</ul>
			</div>
			<div class="mausac">
				<b><h6>Chọn màu:</h6></b>
				@foreach($hanghoa_all->where('TenHH', $hanghoa->TenHH)->where('SoLuongHang', '>', 0) as $color)
				{{-- {{ $color->id }} --}}
					@php
						$array = array($color->gia_tri_thuoc_tinh_1->gia_tri);
					@endphp
						@foreach($array as $value)
							@if ($hanghoa->gia_tri_thuoc_tinh_1->gia_tri == $color->gia_tri_thuoc_tinh_1->gia_tri)
								<i class="fas fa-hand-point-right"></i>
							@endif
						@endforeach
					{{-- <a href="{{ asset("/sanpham/") }}/{{ $color->id }}"> --}}
						<button onclick="test({{ $color->id }})">{{ $color->gia_tri_thuoc_tinh_1['gia_tri'] }}</button>
					{{-- </a> --}}
				@endforeach
			</div>
			<div class="size">
				<b><h6>Chọn size:</h6></b>
				<div id="size">
				@foreach($hanghoa_all_1->where('TenHH', $hanghoa->TenHH)->where('id_gtri_thuoc_tinh_1', $hanghoa->id_gtri_thuoc_tinh_1) as $size)
					@if($size->gia_tri_thuoc_tinh_2)
						@if ($hanghoa->id_gtri_thuoc_tinh_2 == $size->id_gtri_thuoc_tinh_2)
							<i class="fas fa-hand-point-right"></i>
						@endif
					
					{{-- <a href="{{ asset("/sanpham/") }}/{{ $size->id }}"> --}}
						<button>{{ $size->gia_tri_thuoc_tinh_2->gia_tri }}</button>
					{{-- </a> --}}
					@else
						
					@endif
				@endforeach
				</div>
			</div>
			<div class="muangay">
				<div class="muangay-l">
					<a href="{{ asset('AddCart/'.$hanghoa->id) }}"><button>
						<b><p>ĐẶT MUA ONLINE</p></b>
						<p style="font-size:12px;">Giao hàng tận nơi</p>
					</button></a>
				</div>
				<div class="muangay-r">
					<button id="modalBtn" class="button">
						<b><p>MUA TẠI CỬA HÀNG</p></b>
						<p style="font-size:12px;">Xem cửa hàng còn hàng & địa chỉ</p>					
					</button>
				</div>
			</div>
		</div>
		<div class="col-sm-5 col-md-5 col-lg-5 col-xl-5">
			<div id="hinh">
				<img src = "{{ asset('public/upload/AnhSanPham/') }}/{{ $hanghoa->Hinh }}" width = "100%;">
			</div>
		</div>
		<div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
			<div id="hinhminhhoa">
				@foreach($hinhminhhoa as $hh)
					<?php 
					$a = $hh->HinhMinhHoa ;
					$a = explode(" ", $a);
					$count = count($a)-1;
					for($i=0; $i<$count; $i++){
						if($count>0){
					?> 
						<a href="{{ asset('public/upload/AnhMinhHoa') }}/{{ $a[$i] }}" data-lightbox="mygallery">
							<img src="{{ asset('public/upload/AnhMinhHoa') }}/{{ $a[$i] }}"width="50%" style="margin-top:10px;" />
						</a>
						<?php } ?>
				<?php } ?>
				@endforeach
			</div>
		</div>
	<div class="motasp">
		<div class="row" style="padding-bottom: 10px; border-bottom: 5px solid #f3f3f3">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" style="text-align: left;">
				<h5 style="float:left; padding:10px 20px 0px 20px;color:rgba(0,0,0,.54);">MÔ TẢ SẢN PHẨM</h5>
				{{-- <h5 style="float:left; padding:10px 20px 0px 20px;color:rgba(0,0,0,.54);">MÔ TẢ SẢN PHẨM</h5> --}}
			</div>
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" style="text-align: left;">
				<div class="mota" style="padding:0px 20px 0px 20px" id="mota">
					{!! str_replace('//', '</br>', $hanghoa->MoTaHH) !!}
				</div>
			</div>
		</div>
	</div>

	<div class="row"  style="padding-bottom: 10px; border-bottom: 5px solid #f3f3f3;padding:10px 20px 0px 20px;">
		<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" style="text-align: left;">
			<h5 style="float:left; color:rgba(0,0,0,.54);">BÌNH LUẬN</h5>
			{{-- <h5 style="float:left; padding:10px 20px 0px 20px;color:rgba(0,0,0,.54);">BÌNH LUẬN</h5> --}}
		</div>
		<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" style="text-align: left;">
			@if(Auth::guard('kh')->check())
			{{-- @if(isset($chitietdathang)) --}}
			@if(session('thongbao-them'))
				<div class="alert alert-danger">
					{{ session('thongbao-them') }}
				</div>
			@endif
			<div class="form">
				<form action="javascript:void(0)" method="POST" enctype="multipart/form-data" id="CompanyForm">
					<input type="hidden" name="id_KH" id="id_KH" value="{{ Auth::guard('kh')->user()->id }}">
					<input type="hidden" name="id_HH" id="id_HH" value="{{ $id }}">
		            <div class="form-group">
		                <textarea class="form-control" rows="5" cols="1000" id="NoiDung" name="NoiDung" required></textarea>
		            </div>		
					<button type="button" class="btn btn-primary" id="getRequest" onclick="binhluan({{ $hanghoa->id }})">Bình luận</button>
				</form>
				{{-- <form action="{{ asset('/Comment/')  }}/{{ $hanghoa->id }}" method="post" style="text-align: left;">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				  <div class="form-group">
				    <textarea class="form-control" rows="5" cols="1000" id="comment" name="NoiDung" required></textarea>
				    <button class="btn btn-primary" type="submit" name="comment" style="margin:10px 0px 0px 20px;">Bình luận</button>
				  </div>
				</form> --}}
			</div>
			@endif		
		</div>
		@foreach($comment as $cm)	
		<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" style="text-align: left;">		<div id="binhluan" class="binhluan">
				<table width="100%" style="text-align:left; margin-top:10px" >
			      <tr>
			        <td rowspan="2" width="10%" style=""><img src="{{ asset('public/upload/AnhDaiDien/user1.jpg')}}" alt="" style="width: 100px; height: 100px;border-radius: 50%;"></td>
			        <td width="80%"><b>
			        	@if($cm->id_KH != null)
			        		{{ $cm->KhachHang->HoTenKH }}
			        	@else
			        		Người lạ
			        	@endif
			        </b></td>
			      </tr>
			      <tr>
			        <td style="">{{ $cm->NoiDung }}</td>
			      </tr> 
			    </table>
		    </div>
		</div>
		@endforeach
	</div>
	<div class="row"  style="padding-bottom: 10px; border-bottom: 5px solid #f3f3f3;padding:10px 20px 0px 10px">
		<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" style="text-align: left;">
			    <h5 style="float:left; padding:10px 20px 0px 20px;color:rgba(0,0,0,.54);">SẢN PHẨM TƯƠNG TỰ</h5>
			{{-- <h5 style="float:left; padding:10px 20px 0px 20px;color:rgba(0,0,0,.54); ">SẢN PHẨM TƯƠNG TỰ</h5> --}}
		</div>
		<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" style="text-align: left;">
		@foreach($sp_tuongtu as $sptt)
			<div class="card" style="width: 18rem; float: left;margin-left: 10px" >
				<a href="{{ asset('sanpham/') }}/{{ $sptt->id }}">
					<img src = "{{ asset('public/upload/AnhSanPham/') }}/{{ $sptt->Hinh }}" width = "100%" height = "200px" >
				</a>
				<div class="card-body">
					<h5 class="card-title">{{ $sptt->TenHH }}</h5>
					<p class="card-text">{{ number_format($sptt->Gia) }}đ</p>
					<a href="#" class="btn btn-primary">Mua Ngay</a>

				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
<div id="simpleModal" class="modal-bg" >
	<div class="modal-content" >

		<table>
			<tr>	
				<td colspan="2" style="text-align:right; border:none"><span class="closeBtn">&times;</span></td>
			</tr>
			<tr>	
				<td>Tên cửa hàng</td>
				<td>Địa chỉ</td>
			</tr>
			<tr>	
				<td>Yame 01</td>
				<td>1017 Phan Văn Trị, Phường 7, Gò Vấp, Thành phố Hồ Chí Minh</td>
			</tr>
			<tr>	
				<td>Yame 02</td>
				<td>172 Hoàng Văn Thụ, P.09, Q.Phú Nhuận, HCM</td>
			</tr>
			<tr>	
				<td>Yame 03</td>
				<td>164 Nguyễn Chí Thanh, P.03, Q.10, HCM</td>
			</tr>
			<tr>	
				<td>Yame 04</td>
				<td>55 Hòa Bình, P.Tân Thới Hòa, Q.Tân Phú, TP.HCM</td>
			</tr>
		</table>
	</div>
</div>
</div>
<script type="text/javascript" src="{{ asset('/resources/js/nguoidung/sanphamAJ.js')}}"></script>
{{-- chèn script jquery + ajax --}}
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript">

$(document).ready( function () {
	 $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
		$('#getRequest').click(function(e){
			e.preventDefault();
			//khai báo này mới có thể lấy dc dữ liệu theo dạng json bên controller nếu kh có thì data truyền vào là null ($request->all() = null)
        	var NoiDung = $("textarea[name=NoiDung]").val();
        	var id_KH = $("input[name=id_KH]").val();
        	var id_HH = $("input[name=id_HH]").val();
		 	$.ajax({
		        type:"POST",
			    url: "{{ url('/ajax') }}",
			    dataType: 'json',
			    data : { id_KH:id_KH , id_HH:id_HH, NoiDung:NoiDung},
			    success: function(data){
		          	//console.log(data);
		          	alert("Bình luận thành công");
		          	//success.show();
		          	$('#CompanyForm').trigger("reset");
	        },
       	});
	});
	$('#UnLikeRequest').click(function(e){
		e.preventDefault();
		//khai báo này mới có thể lấy dc dữ liệu theo dạng json bên controller nếu kh có thì data truyền vào là null ($request->all() = null)
        	var id_KH = $("input[name=id_KH]").val();
        	var id_HH = $("input[name=id_HH]").val();
		 	$.ajax({
		        type:"POST",
			    url: "{{ url('/unlikeAjax') }}",
			    dataType: 'json',
			    data : { id_KH:id_KH , id_HH:id_HH },
			    success: function(data){
		          	console.log(data);
		          	//alert("Bình luận thành công");
		          	//success.show();
		          	//$('#CompanyForm').trigger("reset");
	        },
	   });
	});

	$('#LikeRequest').click(function(e){
		e.preventDefault();
		//khai báo này mới có thể lấy dc dữ liệu theo dạng json bên controller nếu kh có thì data truyền vào là null ($request->all() = null)
        	var id_KH = $("input[name=id_KH]").val();
        	var id_HH = $("input[name=id_HH]").val();
		 	$.ajax({
		        type:"POST",
			    url: "{{ url('/unlikeAjax') }}",
			    dataType: 'json',
			    data : { id_KH:id_KH , id_HH:id_HH },
			    success: function(data){
		          	console.log(data);
		          	//alert("Bình luận thành công");
		          	//success.show();
		          	//$('#CompanyForm').trigger("reset");
	        },
	   });
	});
});
</script>		
<script>
	function like(){
		if (confirm("Vui lòng đăng nhập") == true) {
			$(location).attr('href', '{{ asset('/loginPages') }}')
		}
	}

	// function add(id){		
	// 	$.ajax({
	// 		url: '../likeProduct/'+id,
	// 		type:"POST",
	// 		data: { id: id },
 //      		dataType: 'json',
 //      		success: function(res){
 //      			alert(res);
 //      		}						
	// 	});
	// }

	var modal = document.getElementById('simpleModal');
	
	var modalBtn = document.getElementById('modalBtn');
	var closeBtn = document.getElementsByClassName('closeBtn')[0];
	
	modalBtn.addEventListener('click', openModal);
	closeBtn.addEventListener('click', closeModal);
	window.addEventListener('click', outsideClick);
	
	function openModal(){
		modal.style.display = 'flex';
	}
	function closeModal(){
		modal.style.display = 'none';
	}
	function outsideClick(e){
		if(e.target == modal){
			modal.style.display = 'none';
		}
	}
	
</script>
@endsection