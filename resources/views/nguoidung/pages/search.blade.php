@extends('index')
@section('content')
<div class="allCate">
	<table style="width:100%">
		<tr >

			<td class="td-left">
				{{-- 	Hiển thị tên danh mục --}}
				@if(count($hanghoa) > 0)
				<b>Tìm thấy {{ count($hanghoa) }} sản phẩm</b>
				@else
					<b>Không tìm thấy sản phẩm '{{ $text }}'</b>
				@endif
				(<a href="{{ asset ('/trangchu')}}">Trang chủ</a>
				<span>></span>
				<span>Tìm kiếm</span>)
				{{-- End Hiển thị tên danh mục --}}
			</td> 				
			<td class="td-right">
				<div class="dropdown">
					<button class="btn btn-secondary dropdown-toggle" style="background-color:white; color:black; border-color: white;"type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Sắp xếp
					</button>

					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" href="{{ asset('/Search/') }}/{{ $text }}/sort-asc">Giá thấp --> cao</a>
						<a class="dropdown-item" href="{{ asset('/Search/') }}/{{ $text }}/sort-desc">Giá cao --> thấp</a>
						<a class="dropdown-item" href="#">Something else here</a>
						
					</div>

				</div>
			</td>				

		</tr>
	</table>
	{{-- 	Hiển thị hàng hóa của danh mục --}}
		@foreach($hanghoa as $hh)
		<div class="card" style="width: 18rem; float:left; margin:5px 7px 5px 5px; background-color: rgb (0 0 0);">


			<a href="{{ asset('sanpham/') }}/{{ $hh->id }}">
				<img src = "{{ asset('public/upload/AnhSanPham') }}/{{ $hh->Hinh }}" width = "100%" height = "200px" >

			</a>
			<div class="card-body">
				<h5 class="card-title">{{ $hh->TenHH}}</h5>
				<p class="card-text" style = "">{{ number_format($hh->Gia)}}đ</p> 
				{{-- <p class="card-text" style = "float:left;padding-left: 50px">{{ number_format($hh->Gia)}}đ</p> 
				<p class="card-text" style = "float:right;padding-right: 50px">{{number_format($hh->Gia)}}đ</p> --}} 
				<a href="{{ asset('AddCart/') }}/{{ $hh->id }}" class="btn btn-primary">Mua Ngay</a>

			</div>
		</div>
		@endforeach
	{{-- 	End Hiển thị hàng hóa của danh mục --}}
</div>
<div class="pages">

</div>
@endsection