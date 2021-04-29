@extends('index')
@section('content')
<style>	
	* { box-sizing: border-box; }

.container {

  display: flex;
  flex-wrap: wrap;
/*  height: 100vh;*/
/*  align-items: center;
  justify-content: center;*/
  /*padding: 0 20px;*/
}

.rating {
  display: flex;
  width: 100%;
  justify-content: center;
  overflow: hidden;
  flex-direction: row-reverse;
/*  height: 150px;*/
  position: relative;
}

.rating-0 {
  filter: grayscale(100%);
}

.rating > input {
  display: none;
}

.rating > label {
  cursor: pointer;
  width: 40px;
  height: 40px;
  margin-top: auto;
  background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23e3e3e3' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
  background-repeat: no-repeat;
  background-position: center;
  background-size: 76%;
  transition: .3s;
}

/*.rating > input:checked ~ label,
.rating > input:checked ~ label ~ label {
  background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23fcd93a' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
}*/


/*.rating > input:not(:checked) ~ label:hover,
.rating > input:not(:checked) ~ label:hover ~ label {
  background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23d8b11e' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
}*/

.emoji-wrapper {
  width: 100%;
  text-align: center;
  height: 100px;
  overflow: hidden;
  position: absolute;
  top: 0;
  left: 0;
}

.emoji-wrapper:before,
.emoji-wrapper:after{
  content: "";
  height: 15px;
  width: 100%;
  position: absolute;
  left: 0;
  z-index: 1;
}

.emoji-wrapper:before {
  top: 0;
  background: linear-gradient(to bottom, rgba(255,255,255,1) 0%,rgba(255,255,255,1) 35%,rgba(255,255,255,0) 100%);
}

.emoji-wrapper:after{
  bottom: 0;
  background: linear-gradient(to top, rgba(255,255,255,1) 0%,rgba(255,255,255,1) 35%,rgba(255,255,255,0) 100%);
}

.emoji {
  display: flex;
  flex-direction: column;
  align-items: center;
  transition: .3s;
}

.emoji > svg {
  margin: 15px 0; 
  width: 70px;
  height: 70px;
  flex-shrink: 0;
}

#rating-1:checked ~ .emoji-wrapper > .emoji { transform: translateY(-100px); }
#rating-2:checked ~ .emoji-wrapper > .emoji { transform: translateY(-200px); }
#rating-3:checked ~ .emoji-wrapper > .emoji { transform: translateY(-300px); }
#rating-4:checked ~ .emoji-wrapper > .emoji { transform: translateY(-400px); }
#rating-5:checked ~ .emoji-wrapper > .emoji { transform: translateY(-500px); }

.feedback {
  max-width: 360px;
  background-color: #fff;
/*  width: 100%;*/
/*  padding: 30px;*/
  border-radius: 8px;
  display: flex;
  flex-direction: column;
  flex-wrap: wrap;
  align-items: center;
}

</style>
<div class="product">
	<table style=" width:100%; ">
		<tr>
			<td style="width:40%;vertical-align:top;text-align:left;">
				<div class="thongtin">
					{{-- Tên vs giá sp --}}
					<div class="tt1">
						<ul>
							{{-- Link --}}
							<a href="{{ asset ('/trangchu')}}">Trang chủ</a>
							<span>></span>
							<a href="{{ asset ('/danhmuc/')}}/{{ $hanghoa->nhomhanghoa->danhmuc->id }}">{{ $hanghoa->nhomhanghoa->danhmuc->TenDanhMuc }}</a>
							<span>></span>
							<a href="{{ asset ('/loaisanpham/')}}/{{ $hanghoa->nhomhanghoa->id }}">{{ $hanghoa->nhomhanghoa->TenNhom }}</a>
							<span>></span>
							<span>{{ $hanghoa->TenHH }}</span>
							{{-- End Link --}}
							<b><li style="font-size:30px;">{{ $hanghoa->TenHH }}</li></b>
							<b><li style="font-size:25px; color:red">{{ number_format($hanghoa->Gia) }}đ</li></b>
						</ul>	
					</div>	
					{{-- Khuyễn mãi đặc biệt --}}
					<div class="tt2">

						<ul style="	border: 2px solid #ea0c0c;">
							<li style="	background-color:#ea0c0c; color:white; height:2em;">KHUYẾN MÃI ĐẶC BIỆT</li>
							<li>• Tặng túi rút YS cho hóa đơn từ 599.000vnd </li>  
							<li>• Tặng trống YS cho hóa đơn từ 799.000vnd </li>
							<li>• Giảm 20% tất cả phụ kiện mua kèm </li>
							<li>• Bảo hành keo trọn đời.</li>
							<li>• Đổi trả trong 30 ngày.</li>
						</ul>
					</div>
				</div>
				<div class="mausac">
					<b><h6>Chọn màu:</h6></b>
					<button>5555</button>
					<button>5555</button>
					<button>5555</button>
				</div>
				<div class="size" >
					<b><h6>Chọn size:</h6></b>
					<button>37</button>
					<button>38</button>
					<button>39</button>
				</div>
				{{-- Mua ngay --}}
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



			</td>

			<td>
				{{-- Hình ảnh gốc --}}
				<div class="left-ha" >
					<img src = "{{ asset('public/upload/AnhSanPham/') }}/{{ $hanghoa->Hinh }}" width = "80%;" height = "80%" >
				</div>
				{{-- Hình minh họa --}}

					<div class="right-ha">
					@foreach($hinhminhhoa as $hh)
					<?php 
					$a = $hh->HinhMinhHoa ;
					$a = explode(" ", $a);
					$count = count($a)-1;
					for($i=0; $i<$count; $i++){
						if($count>0){
					?> 
						<a href="{{ asset('public/upload/AnhMinhHoa') }}/{{ $a[$i] }}" data-lightbox="mygallery">
							<img src="{{ asset('public/upload/AnhMinhHoa') }}/{{ $a[$i] }}"width="50%" height="50%" style="margin-top:10px;" />
						</a>
						<?php } ?>
				<?php } ?>

					</div>

				@endforeach
			</td>
		</tr>

		<tr >
			<td colspan="2" style="border-bottom:2px solid rgba(0,0,0,.10); padding-top:20px; ">

			</td>
		</tr>
		{{-- Mô tả sản phẩm	 --}}	
		<tr >
			<td colspan="2" style=" ">
				<h5 style="float:left; padding:10px 20px 0px 20px;color:rgba(0,0,0,.54);">MÔ TẢ SẢN PHẨM</h5>
			</td>
		</tr>		
		<tr >
			<td colspan="2">
				<div class="mt" style="text-align:left;padding-left:20px;">
				{!! str_replace('//', '</br>', $hanghoa->MoTaHH) !!}

				</div>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="border-bottom:2px solid rgba(0,0,0,.10); padding-top:30px; ">

			</td>
		</tr>
		{{-- End Mô tả sản phẩm	 --}}

		{{-- Bình luận sản phẩm--}}
{{-- 		<tr>
			<td colspan="2" style="">
				<h5 style="float:left; padding:10px 20px 0px 20px;color:rgba(0,0,0,.54); ">ĐÁNH GIÁ</h5>
			</td>
		</tr> --}}
{{-- 		<tr>
			<td>
				<div class="container">
				  <div class="feedback">
				    <div class="rating">
				    	@for($count=1; $count<=5; $count++)
					      <input type="radio" name="rating" id="rating" data-index="{{ $count }}">
					      <label for="rating" onclick="rating()" name="rating" id="rating" data-index="{{ $count }}"></label>
					      <p name="rating" id="rating" data-index="{{ $count }}" onclick="rating()"> {{ $count }}</p>
					      <input type="radio" name="rating" id="rating-4">
					      <label for="rating-4"></label>
					      <input type="radio" name="rating" id="rating-3">
					      <label for="rating-3"></label>
					      <input type="radio" name="rating" id="rating-2">
					      <label for="rating-2"></label>
					      <input type="radio" name="rating" id="rating-1">
					      <label for="rating-1"></label>
					    @endfor
				    </div>
				  </div>
				</div>
			</td>
		</tr> --}}
		{{-- End Mô tả sản phẩm	 --}}

		{{-- Bình luận sản phẩm--}}
		<tr>
			<td colspan="2" style="">
				<h5 style="float:left; padding:10px 20px 0px 20px;color:rgba(0,0,0,.54); ">BÌNH LUẬN</h5>
			</td>
		</tr>
		@if(Auth::guard('kh')->check())
			{{-- @if(isset($chitietdathang)) --}}
			@if(session('thongbao-them'))
				<div class="alert alert-danger">
					{{ session('thongbao-them') }}
				</div>
			@endif
				<tr>
					<td colspan="2">
						<form action="{{ asset('/Comment/')  }}/{{ $hanghoa->id }}" method="post" style="text-align: left;">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						  <div class="form-group">
						    <textarea class="form-control" rows="5" id="comment" name="NoiDung" required></textarea>
						    <button class="btn btn-primary" type="submit" name="comment" style="margin:10px 0px 0px 20px;">Bình luận</button>
						  </div>
						</form>
						</div>
					</td>
				</tr>
			{{-- @endif --}}
		@endif
		{{-- End Bình luận sản phẩm--}}

		{{-- Hiển thị bình luận --}}
		@foreach($comment as $cm)	
		<tr style="">
			<td colspan="2">
				<table width="100%" style="text-align:left; margin-top:10px" >
			      <tr>
			        <td rowspan="2" width="10%" style=""><img src="{{ asset('public/upload/AnhDaiDien/user1.jpg')}}" alt="" style="width: 100px; height: 100px;border-radius: 50%;"></td>
			        <td width="80%"><b>
			        	@if($cm->ID_KH != null)
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
			</td>
		</tr>

		<tr>
			<td colspan="2" style="border-bottom:2px solid rgba(0,0,0,.10); padding-bottom:10px; ">
			</td>
		</tr>
		@endforeach
		{{-- End Hiển thị bình luận  --}}

		<tr >
			<td colspan="2" style="border-bottom:2px solid rgba(0,0,0,.10); padding-top:30px; ">

			</td>
		</tr>
		<tr >
			<td colspan="2" style="">
				<h5 style="float:left; padding:10px 20px 0px 20px;color:rgba(0,0,0,.54); ">SẢN PHẨM TƯƠNG TỰ</h5>
			</td>
		</tr>	
		<tr >


			<td colspan="2" > 
				<div class="sptt">
					@foreach($sp_tuongtu as $sptt)
					<div class="card" style="width: 18rem;">
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
			</td>
		</tr>

	</table>

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
<script>

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
{{-- <style>
/*Nền của table đỉa chỉ cửa hàng của sản phẩm*/
.modal-bg{
	display:none;
	position: fixed;
	top:0;
	left:0;
	width:100%;
	height:100%;
	background-color: rgba(0,0,0,0.5);

	z-index:100;
	overflow:auto;

}

/*Table đỉa chỉ cửa hàng của sản phẩm*/
.modal-content{
	background-color:white;
	margin:12% auto;
	padding:20px;
	width:70%;

	box-shadow:0 5px 8px 0;
	
}
.modal-bg .modal-content td{
	border:2px solid rgba(0,0,0,1);
	padding: 5px 0 5px 0;
}

/*Nút X của table địa chỉ cửa hàng của sản phẩm*/
 .closeBtn{
	color:#ccc;
	text-align:right;
	font-size:30px;
}

.closeBtn:hover,.closeBtn:focus{
	color:black;
	text-decoration:none;
	cursor:pointer;
	
}
</style>
--}}

@endsection