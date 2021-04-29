@extends('index')
@section('content')
<style>
	.alertify-notifier.ajs-right .ajs-message.ajs-visible{
		left:1000px;
	}
</style>
	<div class = "quangcao-t">  
		<div class="dieuhuong">
			<div class="left">
				<svg onclick="Back();" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-left-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5.5a.5.5 0 0 0 0-1H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5z"/>
				</svg>
			</div>
			<div class="right">
				<svg onclick="Next();" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-11.5.5a.5.5 0 0 1 0-1h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5z"/>
				</svg>
			</div>
		</div>
		<div class="chuyen-slide">
			<a href="#" ><img src="{{ asset('public/upload/AnhTrangChu/1.jpg') }}" > </a> //0
			<a href="#" ><img src="{{ asset('public/upload/AnhTrangChu/4.jpg') }}" > </a> //1200
			<a href="#" ><img src="{{ asset('public/upload/AnhTrangChu/6.jpg') }}" > </a> //2400
			<a href="#" ><img src="{{ asset('public/upload/AnhTrangChu/2.jpg') }}" > </a> //3600
			<a href="#" ><img src="{{ asset('public/upload/AnhTrangChu/7.jpg') }}" > </a> //4800
		</div>
	</div>
	
	<div class="mid-t">
		@foreach($danhmuc as $dm)
		<div class="number1">
			<table>
				<tr>
					<td class="td-left">
						<b><a href="{{ asset('/danhmuc/') }}/{{ $dm->id }}">{{ $dm->TenDanhMuc }}</a>
					</td>
					<td class="td-right">
						<ul> 
							@foreach($dm->NhomHangHoa as $nhh)
							<a href="{{ asset('/loaisanpham/') }}/{{ $nhh->id }}">
								<li>{{ $nhh->TenNhom }}</li>
							</a>
							@endforeach
						</ul>
					</td>
				</tr>
			</table>
			<?php 
				$hanghoa = $dm->HangHoa->sortByDesc('id')->take(4);
			?>
			@foreach($hanghoa as $hh)
			<div class="card" style="width: 18rem;">
				<a href="{{ asset('/sanpham/') }}/{{ $hh->id }}">
					<img src = "{{ asset('public/upload/AnhSanPham/') }}/{{ $hh->Hinh }}" width = "100%" height = "200px" >

				</a>
				<div class="card-body">
					<h5 class="card-title">{{ $hh->TenHH }}</h5>
					<span class="sale">-30%</span>
					<p class="card-text">{{ number_format($hh->Gia) }}đ 
						<sup style="position: absolute; top: 260px; text-decoration: line-through;">1.500.000</sup>
					</p>
					{{-- <a href="{{ asset('/AddCart/'.$hh->MSHH) }}" class="btn btn-primary" onclick="addAlert({{ $hh->MSHH }})" >Mua Ngay</a> --}}
					<a href="javascript:" class="btn btn-primary add_to_cart" data-id="{{ $hh->id }}" onclick="add({{ $hh->id }})">Mua Ngay</a>

				</div>
			</div> 
			 @endforeach

		</div>
		@endforeach
	</div>
{{-- <script>
function myFunction() {
  alertify.success('Success message');
}
</script> --}}
{{-- ajax --}}
{{-- <div class="alertify-notifier ajs-bottom ajs-right">
	<div class="ajs-message ajs-success ajs-visible">Thêm thành công</div>
</div> --}}
<script type="text/javascript" src="{{ asset('/resources/js/nguoidung/cartAJ.js')}}"></script>
<script type="text/javascript" src="{{ asset('/resources/js/nguoidung/chuyenslide.js')}}"></script>
{{-- <button onclick="myFunction()">Click me</button> --}}
@endsection