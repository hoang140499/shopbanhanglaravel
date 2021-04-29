@extends('index')
@section('content')
<style>
	.alertify-notifier.ajs-right .ajs-message.ajs-visible{
		left:1000px;
	}
</style>
<div class="allCate">
	<table style="width:100%">
		<tr >
			@foreach($danhmucc as $dm)
			<td class="td-left">
				{{-- 	Hiển thị tên danh mục --}}
				<b>{{ $dm->TenDanhMuc }}</b>
				(<a href="{{ asset ('/trangchu')}}">Trang chủ</a>
				<span>></span>
				<span>{{ $dm->TenDanhMuc }}</span>)
				{{-- End Hiển thị tên danh mục --}}
			</td> 				
			<td class="td-right">
				<div class="dropdown">
					<button class="btn btn-secondary dropdown-toggle" style="background-color:white; color:black; border-color: white;"type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Sắp xếp
					</button>

					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" href="{{ asset('/danhmuc/') }}/{{ $dm->id }}/sort-asc"">Giá thấp --> cao</a>
						<a class="dropdown-item" href="{{ asset('/danhmuc/') }}/{{ $dm->id }}/sort-desc">Giá cao --> thấp</a>
						<a class="dropdown-item" href="#">Something else here</a>

					</div>

				</div>
			</td>				
			@endforeach
		</tr>
	</table>
	{{-- 	Hiển thị hàng hóa của danh mục --}}
		@foreach($hanghoa as $hh)
		<div class="card" style="width: 18rem; float:left; margin:5px 7px 5px 5px; background-color: rgb (0 0 0);">


			<a href="{{ asset('sanpham/'.$hh->id) }}">
				<img src = "{{ asset('public/upload/AnhSanPham') }}/{{ $hh->Hinh }}" width = "100%" height = "200px" >

			</a>
			<div class="card-body">
				<h5 class="card-title">{{ $hh->TenHH}}</h5>
				<p class="card-text" style = "">{{ number_format($hh->Gia)}}đ</p> 
				{{-- <p class="card-text" style = "float:left;padding-left: 50px">{{ number_format($hh->Gia)}}đ</p> 
				<p class="card-text" style = "float:right;padding-right: 50px">{{number_format($hh->Gia)}}đ</p> --}} 
				<a href="javascript:" class="btn btn-primary add_to_cart" data-id="{{ $hh->id }}" onclick="add({{ $hh->id }})">Mua Ngay</a>

			</div>
		</div>
		@endforeach
	{{-- 	End Hiển thị hàng hóa của danh mục --}}

</div>
<div class="alertify-notifier ajs-bottom ajs-right">
	<div class="ajs-message ajs-success ajs-visible">Thêm thành công</div>
</div>
<div class="pages">
	{!! $hanghoa->links() !!}
</div>
<script type="text/javascript" src="{{ asset('/resources/js/nguoidung/cartAJ-loaisanpham.js')}}"></script>
@endsection