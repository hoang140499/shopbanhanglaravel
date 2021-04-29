@extends('index')
@section('content')
<div class="Account">
	<div class="row" >
		@include('nguoidung.pages.menuAC')
		<div class="col-sm-10 col-md-10 col-lg-10 col-xl-10" >
			<b><h2>SẢN PHẨM YÊU THÍCH</h2></b>
			<div class="likeProductAccount" >			
				<div class="row ">
					<div class="col-sm-2 col-md-2 col-lg-2 col-xl-2" >
						<img src="{{ asset ('/public/upload/AnhDaiDien/user1.jpg') }}" alt="" style="width: 100px; height: 100px;">
					</div>


					<div class="col-sm-5 col-md-5 col-lg-5 col-xl-5" style="margin-top: 15px; font-weight: bold;">
						Quần jean 198x
						<div class="row">
							<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" style="margin-top: 10px">
								Xóa
							</div>
						</div>
					</div>


					<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3"  style="margin-top: 30px; color: red; font-weight: bold;">
						250.000.000
					</div>


					<div class="col-sm-2 col-md-2 col-lg-2 col-xl-2" style="margin-top: 30px">
						Thêm vào giỏ hàng
					</div>


				</div>
			</div>
			
		</div>
	</div>
</div>
@endsection