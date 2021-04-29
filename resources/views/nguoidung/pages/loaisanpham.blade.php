@extends('index')
@section('content')
<style>

	.alertify-notifier.ajs-right .ajs-message.ajs-visible{
		left:1000px;
	}

	/*.number1{
		height:413px;
		margin:5px 0px 0px 0px;
		background-color: rgb (0 0 0);
		border-bottom: 20px solid rgba(0, 0, 0, 5%);



	}


	.number1 .card{

		float:left;
		margin-left:10px;
	}

	.btn-primary {
		color: #fff;
		background-color: #28a745;
		border-color: #28a745;
	}

	.btn-primary:hover {
		color: #fff;
		background-color: #139e33;
		border-color: #139e33;
	}
	.td-left{
		float:left;
		font-size:25px;
		padding-left:20px;

	}

	.td-right{
		text-align:right;
		width:70%;
		padding-right:20px;

	}
	.pages{
		  width: 100%;
		  height: 50px;
		  background: black;
		  bottom: 0px;
	}
	.pages svg{
		width: 3%;
		height:3%;
	}
	*/
</style>
<div class="allCate">
	<table style="width:100%">
		<tr >
			<td class="td-left">
				@foreach($nhomhanghoaa as $value)
				<b>{{ $value->TenNhom }}</b>
				(<a href="{{ asset ('/trangchu')}}">Trang chủ</a>
								<span>></span>
				<a href="{{ asset ('/danhmuc/')}}/{{ $value->danhmuc->id }}">{{ $value->danhmuc->TenDanhMuc }}</a>
								<span>></span>
				<span>{{ $value->TenNhom }}</span>)
				@endforeach
			</td>
			<td class="td-right">
				<div class="dropdown">
					<button class="btn btn-secondary dropdown-toggle" style="background-color:white; color:black; border-color: white;"type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Sắp xếp
					</button>
					@foreach($nhomhanghoaa as $value)
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" href="{{ asset('/loaisanpham/') }}/{{ $value->id }}/sort-asc">Giá thấp --> cao</a>
						<a class="dropdown-item" href="{{ asset('/loaisanpham/') }}/{{ $value->id }}/sort-desc">Giá cao --> thấp</a>
						<a class="dropdown-item" href="#">Something else here</a>

					</div>
					@endforeach
				</div>
			</td>
		</tr>
	</table>

	@foreach($hanghoa as $value)
	<div class="card" style="width: 18rem; float:left; margin:5px 7px 5px 5px; background-color: rgb (0 0 0);">


		<a href="{{ asset('sanpham/'.$value->id) }}">
			<img src = "{{ asset('public/upload/AnhSanPham') }}/{{ $value->Hinh }}" width = "100%" height = "200px" >

		</a>
		<div class="card-body">
			<h5 class="card-title">{{ $value->TenHH }}</h5>
			<p class="card-text">{{ number_format($value->Gia) }}đ</p>
			<a href="javascript:" class="btn btn-primary add_to_cart" data-id="{{ $value->id }}" onclick="add({{ $value->id }})">Mua Ngay</a>

		</div>
	</div>
	@endforeach
</div>

<div class="pages">
	{!! $hanghoa->links() !!}
</div>
<script type="text/javascript" src="{{ asset('/resources/js/nguoidung/cartAJ-loaisanpham.js')}}"></script>
@endsection

