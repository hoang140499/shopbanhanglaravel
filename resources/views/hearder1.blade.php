<div class = "tieude">
	<div class = "left">
		<a href="{{URL::to ('/trangchu') }}" >  <img src="{{ asset('public/upload/AnhTrangChu/logo2.png')}}" width="100px" height="100px" style="margin-top:20px" >
		</a>
	</div>
	<div class = "mid"> 
		<marquee style=" color:white;margin-top:10px" scrollamount="10" scrolldelay="120">
			Website bán hàng chính thức của Yame | Liên hệ: 1900.1999 để biết thêm chi tiết
		</marquee>
		<form class="form-inline" style="margin:7px 5px 5px 8px" action="{{ asset('/Search') }}" method="get">
			<input class="form-control mr-sm-2" style="width:85%; "type="search" name="searchtext" placeholder="Nhập sản phẩm bạn cần tìm ..." aria-label="Search">
			<button class="btn btn-outline-success my-2 my-sm-0" style="width:10%" type="submit" name=""> Search</button>
		</form>              
		<nav class="navbar1 navbar-expand-lg navbar-light bg-dark1" ">               
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav" >
					<li class="nav-item">
						<a class="nav-link" href="{{ asset('/diachi') }}">MAP</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">SALE</a>
					</li>
					@foreach($danhmuc as $dm)
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" 
						value="">
						{{ $dm->TenDanhMuc }}
						</a>

						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							@foreach($dm->NhomHangHoa as $nhh)
							<a class="dropdown-item" href="{{ asset('/loaisanpham') }}/{{ $nhh->MaNhom }}">{{ $nhh->TenNhom }}</a>
							@endforeach
						</div>

					</li>
					@endforeach
				</ul>

			</div>
		</nav>
	</div>

	<div class = "right">
		<table>
			<tr>
				<td class="cart" style="width:34%; height:140px">
					<div class="cart-icon">
						{{-- Icon --}} 
						<a href="{{ asset('/ListCart') }}" style="color: white; top:10px;  ">
							<svg width="40%" height="80%" viewBox="0 0 16 16" class="bi bi-cart" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 
								12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 
								12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
							</svg>
						</a> 
						{{-- End Icon --}} 

						{{-- Giỏ hàng ajax --}} 
						<div class="cart-item">
							<b>GIỎ HÀNG</b>
							<table style="width: 100%;" class="list">
								{{-- Sản phẩm 1 --}}
								<tr>
									<td rowspan="2"><img src="{{ asset('public/upload/AnhTrangChu/logo2.png')}}" alt="" style="width: 70px; height: 70px;"></td>
									<td>Ronaldo delima</td>
									<td rowspan="2"><i class="far fa-trash-alt"></i></td>
								</tr>
								<tr>
									<td>5.000.000</td>
								</tr>
								{{-- Sản phẩm 2 --}}
								<tr>
									<td rowspan="2"><img src="{{ asset('public/upload/AnhTrangChu/logo2.png')}}" alt="" style="width: 70px; height: 70px;"></td>
									<td>Ronaldo delima</td>
									<td rowspan="2"><i class="far fa-trash-alt"></i></td>
								</tr>
								<tr>
									<td>5.000.000</td>
								</tr>

							</table>
						</div>
						{{-- End Giỏ hàng ajax --}} 
					</div>
					<b><p style="  position: absolute;right:20%; top: 25px;z-index: 10; color:red">
						@if(Session::has("cart") != null)

						({{ number_format(Session::get('cart')->totalSoluong) }})
						@else
						(0)
						@endif
					</p></b>

				</td>
				@if(Auth::guard('member')->check())
				<td class="login" style="width:66%">
					<div class="user">
						<div class="anhdaidien"><img src="{{ asset('public/upload/AnhDaiDien/user1.jpg') }}" style="height: 50px; width: 50px; border-radius: 50%" alt=""></div>
						<ul>
							<li><b>Xin chào: {{ Auth::guard('member')->user()->name }}</b></li>
							<li><a href="">Thông tin tài khoản</a></li>
							<li><a href="">Đơn hàng</a></li>
							<li><a href="{{ route('logoutPages') }}">Đăng xuất</a></li>
						</ul>
					</div>
				</td>
				@else
				{{-- Form login --}}
				<td class="login" style="width:36%">
					<a href="{{ route('loginPages') }}">
						<button type="button" class="btn btn-success" style="">Đăng nhập</button>
					</a>
				</td>
				{{-- End Form login --}}

				{{-- Form register --}}
				<td class="register" style="width:30%">
					<a href="{{ route('registerPages') }}">
						<button type="button" class="btn btn-success" style="">Đăng ký</button>
					</a>
				</td>
				{{-- End Form register --}}
				@endif
			</tr>
		</table>
	</div>
</div> 