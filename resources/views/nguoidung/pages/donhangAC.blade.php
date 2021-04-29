@extends('index')
@section('content')
<div class="Account">
	<div class="menuOrder">
		<div class="row" >
			@include('nguoidung.pages.menuAC')
			<div class="col-sm-10 col-md-10 col-lg-10 col-xl-10">
				<div class="row"  style="padding: 10px">
					<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
					   	<form class="" style="" action="{{ asset('/account/listOrder') }}" method="get">
							<button name="type" class="" style="" type="submit" value="1"> 
								Tất cả
							</button>
						</form> 
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
						<form class="" style="" action="" method="get">
							<button name="type" class="" style="" type="submit" value="2"> 
								Chưa xem
							</button>
						</form> 	
					</div>	
					<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
						<form class="" style="" action="" method="get">
							<button name="type" class="" style="" type="submit" value="3"> 
								Đã xác nhận
							</button>
						</form> 
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
						<form class="" style="" action="" method="get">
							<button name="type" class="" style="" type="submit" value="4"> 
								Hoàn thành
							</button>
						</form> 
					</div>
				</div>
				<div class="row" style="background-color: #f3f3f3; padding: 10px;"></div>

				<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" style="">
					<div class="row " style="padding: 15px">
						<div class="col-sm-1 col-md-1 col-lg-1 col-xl-1" style="font-weight: bold;">
							MSHH
						</div>


						<div class="col-sm-5 col-md-5 col-lg-5 col-xl-5" style="font-weight: bold;">
							Thông tin													
						</div>


						<div class="col-sm-2 col-md-2 col-lg-2 col-xl-2"  style="font-weight: bold;">
							Đơn giá
						</div>

						<div class="col-sm-2 col-md-2 col-lg-2 col-xl-2" style="font-weight: bold;">
							Ngày đặt
						</div>

						<div class="col-sm-2 col-md-2 col-lg-2 col-xl-2" style="font-weight: bold;">
							Thao tác
						</div>

					</div>
				</div>

				@foreach($dathang as $dh)
					<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" style="box-shadow: 5px 5px 5px #d6dad2">					
						@foreach($dh->ChiTietDatHang as $ctdh)
							<div class="row" style="padding: 15px">
								<div class="col-sm-1 col-md-1 col-lg-1 col-xl-1" style="">
									{{ $ctdh->id_HH }}

								</div>


								<div class="col-sm-5 col-md-5 col-lg-5 col-xl-5" style=" font-weight: bold;">
									<table>
										<tr>
											<td>
												<img src="{{ asset('public/upload/AnhSanPham/') }}/{{ $ctdh->HangHoa->Hinh }}" alt="" style="width: 60px; height: 60px;">
											</td>
											<td style="transform: translateY(0%);float: left; padding-left: 12px;text-transform: uppercase;">
												<h6>{{ $ctdh->HangHoa->TenHH }}</h6>
												<h6 style="float: left;">x{{ $ctdh->SoLuong }}</h6>
											</td>
										</tr>
									</table>						
								</div>


								<div class="col-sm-2 col-md-2 col-lg-2 col-xl-2"  style=" color: red; font-weight: bold;">
									{{ number_format($ctdh->HangHoa->Gia) }} VNĐ
								</div>

								<div class="col-sm-2 col-md-2 col-lg-2 col-xl-2"  style="">																		
									{{ $dh->NgayDH }}	
								</div>
								<div class="col-sm-2 col-md-2 col-lg-2 col-xl-2" style="">
									<a href="">Xem chi tiết</a>
								</div>
							</div>
							<div class="row" style="background-color: #f3f3f3; padding: 1px;"></div>
						@endforeach		
						<div class="total-money" style=" margin-right: auto ;text-align: right; padding: 10px; " >
							<h4>Tổng tiền: {{ number_format($dh->TongTien) }}đ</h4>
						</div>	
					</div>
				<div class="row" style="background-color: #f3f3f3; padding: 10px;"></div>
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection