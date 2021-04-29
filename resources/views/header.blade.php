<div class = "tieude">
	<div class="row">
		{{-- LOGO --}}
		<div class = "col-sm-2 col-md-2 col-lg-2 col-xl-2">
			<div class="left">
				<a href="{{URL::to ('/trangchu') }}" >  <img src="{{ asset('public/upload/AnhTrangChu/logo2.png')}}" width="100px" height="100px" style="margin-top:20px" >
				</a>
			</div>
		</div>
		{{-- END LOGO --}}

		{{-- MENU --}}
		<div class = "col-sm-7 col-md-7 col-lg-7 col-xl-7">
			<div class="mid">
				<marquee style=" color:white;margin-top:10px" scrollamount="10" scrolldelay="120">
					Website bán hàng chính thức của Yame | Liên hệ: 1900.1999 để biết thêm chi tiết
				</marquee>
				{{-- TÌM KIẾM --}}
				<form class="form-inline" style="margin:7px 5px 5px 8px" action="{{ asset('/Search') }}" method="get">
					<input class="form-control mr-sm-2" style="width:88%; "type="search" name="searchtext" placeholder="Nhập sản phẩm bạn cần tìm ..." aria-label="Search" required="">
					<button class="btn btn-outline-success my-2 my-sm-0" style="width:10%" type="submit" name=""> Search</button>
				</form>  
				{{-- END TÌM KIẾM --}} 
				{{-- DROPDOWN --}}           
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
									<a class="dropdown-item" href="{{ asset('/loaisanpham') }}/{{ $nhh->id }}">{{ $nhh->TenNhom }}</a>
									@endforeach
								</div>

							</li>
							@endforeach
						</ul>

					</div>
				</nav>
				{{-- END DROPDOWN --}}
			</div>
		</div> 
		{{-- END MENU --}}

		{{-- GIỎ HÀNG & ACCOUNT --}}
		<div class = "col-sm-3 col-md-3 col-lg-3 col-xl-3" >
			<div class="right">
				<div class="row">
					{{-- GIỎ HÀNG --}}
					<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<div class="cart" style="">
							<div class="cart-icon" style="transform: translateY(100%);">
								{{-- Icon --}} 
								<a href="{{ asset('/ListCart') }}" style="color: white; top:10px; ">
									<svg width="30%" height="80%" viewBox="0 0 16 16" class="bi bi-cart" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 
										12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 
										12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
									</svg>
								</a> 
								{{-- End Icon --}} 

								{{-- Giỏ hàng ajax --}}
								@if(Session::has("cart")!=null) 
								<div class="cart-item" >
									<b>GIỎ HÀNG</b>
									<table style="width: 100%;" class="list"  id="change-item-cart">
										{{-- Sản phẩm 1 --}}
										@foreach(Session::get("cart")->products as $item)
										<div class="change-item-cart">
											<tr>
												<td rowspan="2"><img src="{{ asset('public/upload/AnhSanPham/')}}/{{ $item['thongtin']->Hinh }}" alt="" style="width: 70px; height: 70px;"></td>
												<td>{{  $item['thongtin']->TenHH }}</td>
												<td rowspan="2" class="delete-item">
													<a href="javascript:" onclick="del({{  $item['thongtin']->id }})" data-id="{{  $item['thongtin']->id }}">
														Xóa
													</a>
												</td>
											</tr>
											<tr>
												<td style="color: red; ">{{  number_format($item['thongtin']->Gia) }} x {{ $item['soluong'] }}</td>
											</tr>
										</div>
										@endforeach
									</table>
								</div>
								@else
								<div class="cart-item" >
									<b>GIỎ HÀNG</b>
									<table style="width: 100%;" class="list"  id="change-item-cart">
									</table>
								</div>
								@endif

								{{-- End Giỏ hàng ajax --}} 
							</div>
							<b><p style="  position: absolute;right:43%; top: 25px;z-index: 10; color:red">
								@if(Session::has("cart") != null)

								<span id="total-quanty-show">({{ number_format(Session::get('cart')->totalSoluong) }})</span>
								@else
								<span id="total-quanty-show">(0)</span>
								@endif
							</p></b>

						</div>
					</div>
					{{-- END GIỎ HÀNG --}}

					{{-- ACCOUNT --}}
					@if(Auth::guard('kh')->check())
					<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<div class="user">
							<div class="anhdaidien"><img src="{{ asset('public/upload/AnhDaiDien/user1.jpg') }}" style="height: 50px; width: 50px; border-radius: 50%" alt="">
							</div>
							<ul>
								<li><b>Xin chào: {{ Auth::guard('kh')->user()->HoTenKH }}</b></li>
								<a href="{{ route('getAccountProfile') }}"><li>Thông tin tài khoản</li></a>
								<a href="{{ route('getAccountListOrder') }}"><li>Đơn hàng</li></a>
								<a href="{{ route('logoutPages') }}"><li>Đăng xuất</li></a>
							</ul>
						</div>
					</div>
					@else
					<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<div class="login" style="transform: translateY(130%);">
							{{-- Form register --}}
							{{-- <a href="{{ route('registerPages') }}">
								<button type="button" class="btn btn-success" style="border-radius: 20%">Đăng ký</button>
							</a> --}}
							{{-- End Form register --}}

							{{-- Form login --}}
							<a href="{{ route('loginPages') }}">
								<button type="button" class="btn btn-outline-success" style="">
									<i class="fas fa-user-circle"></i>
									Đăng nhập
								</button>
							</a>
							{{-- End Form login --}}
						</div>
					</div>
				{{--  END ACCOUNT --}}
				@endif
				</div>
			</div>
		</div>
		{{-- END GIỎ HÀNG & ACCOUNT --}}
	</div>
</div> 