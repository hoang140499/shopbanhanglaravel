@extends('index')
@section('content')
<script type="text/javascript">
	function cong(){
		var t = document.getElementById('textbox').value;
		document.getElementById("textbox").value=parseInt(t)+1;
	}
	function tru(){
		var t = document.getElementById('textbox').value;
		document.getElementById("textbox").value=parseInt(t)-1;
	}
</script>
<div class="tab">
	<ul>
		<li class="tab1">Giỏ hàng của bạn</li>
		<li class="tab2"><a href="{{ asset('trangchu') }}">Tìm thêm sản phẩm khác ></a></li>
	</ul>
</div>

@if(Session::has('thongbao-thanhcong'))
	<div>
		&nbsp;
	<div class="alert alert-success">
		{{ Session::get('thongbao-thanhcong') }}
	</div>
	</div>
@endif
@if(Session::has('thongbao-cartNull'))
	<div>
		&nbsp;
	<div class="alert alert-danger">
		{{ Session::get('thongbao-cartNull') }}
	</div>
	</div>
@endif
<div class="giohang">
	<table>
		<tr class="nb1">
			<td >Hình ảnh</td>
			<td >Tên sản phẩm</td>
			<td >Màu Sắc</td>
			<td >Size</td>
			<td >Đơn giá</td>
			<td >Số lượng</td>
			<td >Thành tiền</td>
			<td >Thao tác</td>
		</tr>
		@if(Session::has("cart") != null)
		@foreach(Session::get('cart')->products as $item)
				{{-- {{ $item['thongtin']->SoLuongHang }}
				{{ $item['soluong'] }} --}}
		<tr class="nb2">
			<td><img src="{{ asset('public/upload/AnhSanPham/') }}/{{ $item['thongtin']->Hinh }}" width="120" height="120" /> </td>
			<td><b>{{ $item['thongtin']->TenHH }}</td>
				<td style="color:red">{{ $item['thongtin']->Mau }}</td>
				<td style="color:red">{{ $item['thongtin']->Size }}</td>
				<td style="color:red">{{ $item['thongtin']->Gia }}</td>

				@if($item['soluong'] > 1 && $item['soluong'] >= $item['thongtin']->SoLuongHang)
				<td>
					<a href="{{ asset('/MinusCart/'. $item['thongtin']->id) }}">
						<i class="fas fa-minus-circle"></i>
					</a>
					{{ $item['soluong'] }} (SL tối đa)
{{-- 					<a href="{{ asset('/AddCart/'. $item['thongtin']->MSHH) }}">
						<svg style="font-size:20px;" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" d="M8 3.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5H4a.5.5 0 0 1 0-1h3.5V4a.5.5 0 0 1 .5-.5z"/>
							<path fill-rule="evenodd" d="M7.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0V8z"/>
							<path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						</svg>
					</a>	 --}}			
				</td>
				

				@elseif($item['soluong'] > 1 && $item['soluong'] < $item['thongtin']->SoLuongHang)	
				<td>
					<a href="{{ asset('/MinusCart/'. $item['thongtin']->id) }}">
						<i class="fas fa-minus-circle"></i>
					</a>
					{{ $item['soluong'] }}
					<a href="{{ asset('/AddCart/'. $item['thongtin']->id) }}">
						<i class="fas fa-plus-circle"></i>
					</a>				
				</td>			


				@else	
				<td>
					<a href="{{ asset('/Delete-Item-Cart/'. $item['thongtin']->id) }}">
						<i class="fas fa-minus-circle"></i>
					</a>
					{{ $item['soluong'] }}
					<a href="{{ asset('/AddCart/'. $item['thongtin']->id) }}">
						<i class="fas fa-plus-circle"></i>
					</a>				
				</td>			
				@endif


				<td style="color:red"><b>{{ number_format($item['thongtin']->Gia * $item['soluong'])  }}</b></td>
				<td style="font-size:20px;">
					<a href="{{ asset('/Delete-Item-Cart/') }}/{{ $item['thongtin']->id }}">
						<i class="fas fa-trash-alt"></i>
					</a>
				</td>
			</tr>
				@endforeach
				@endif
				<tr class="nb3" >
					<td colspan="8" style="text-align:right; font-weight:bold; padding:15px">
						@if(Session::has("cart") != null)
						Tổng tiền = {{ number_format(Session::get('cart')->totalPrice) }}VNĐ </br>
						Số lượng = {{ number_format(Session::get('cart')->totalSoluong) }}
						@else
						Giỏ hàng rỗng
						@endif
					</td>		
				</tr>
				@if(Auth::guard('kh')->check())
				<form action="{{ URL::to('/ThanhToan') }}" method="post" enctype="multipart/form-data">	
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<tr class="nb4" >
						<td colspan="4" class="left" ><input type="text" maxlength="40" name="HoTenKH" placeholder="Họ và tên" required hidden="" value="{{ Auth::guard('kh')->user()->HoTenKH }}"></td>		
						<td colspan="4" class="right"><input type="text" maxlength="10" name="SoDienThoai" placeholder="Số điện thoại" required hidden="" value="{{ Auth::guard('kh')->user()->SoDienThoai }}"></td>		
					</tr>
					<tr class="nb5" >
						<td colspan="8" class="mid" ><input type="text" name="DiaChi" placeholder="Đỉa chỉ" required hidden="" value="{{ Auth::guard('kh')->user()->DiaChi }}"></td>				
					</tr>
					<tr class="nb6" >

						<td colspan="8" class="submit" ><input type="submit" name="thanhtoan" value="THANH TOÁN" ></td>				

					</tr>
				</form>
				@else
				<form action="{{ URL::to('/ThanhToan') }}" method="post" enctype="multipart/form-data">	
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<tr class="nb4" >
						<td colspan="4" class="left" ><input type="text" maxlength="40" name="HoTenKH" placeholder="Họ và tên" required></td>		
						<td colspan="4" class="right"><input type="text" maxlength="10" name="SoDienThoai" placeholder="Số điện thoại" required></td>		
					</tr>
					<tr class="nb5" >
						<td colspan="8" class="mid" ><input type="text" name="DiaChi" placeholder="Đỉa chỉ" required></td>				
					</tr>
					<tr class="nb6" >

						<td colspan="8" class="submit" ><input type="submit" name="thanhtoan" value="THANH TOÁN" ></td>				

					</tr>
				</form>
				@endif
			</table>
		</div>
		@endsection



