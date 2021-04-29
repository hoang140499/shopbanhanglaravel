@extends('admin-crud.index')
@section('content')
<div class="container-fluid">
	<div class="row" >
		<div class="col-sm-10 col-md-10 col-lg-10 col-xl-10">
			<b><h2>THÔNG TIN TÀI KHOẢN</h2></b>
			@if(session('thongbao-sua'))
				<div class="alert alert-success">
					{{ session('thongbao-sua') }}
				</div>
			@endif
			<div class="profileAccount">
				<form method="POST" enctype="multipart/form-data">
				@csrf
				  <div class="form-row">
				    <div class="form-group col-md-6">
				      <label for="inputEmail4">Họ tên</label>
				      <input type="text" class="form-control" id="inputEmail4" name="name" placeholder="Họ tên" value="{{ Auth::guard('member')->user()->name }}">
				    </div>
				    <div class="form-group col-md-6">
				      <label for="inputPassword4">Số điện thoại</label>
				      <input type="text" class="form-control" id="inputPassword4" name="phone" placeholder="Số điện thoại" value="{{ Auth::guard('member')->user()->phone }}">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="inputAddress">Địa chỉ</label>
				    <input type="text" class="form-control" id="inputAddress" name="address" placeholder="Địa chỉ" value="{{ Auth::guard('member')->user()->address }}">
				  </div>
				  <div class="form-group">
				    <label for="inputAddress2">Email</label>
				    <input type="email" class="form-control" id="inputAddress2" name="email" placeholder="Email" value="{{ Auth::guard('member')->user()->email }}" disabled>
				  </div>
				  <button type="submit" class="btn btn-primary" style="display: list-item; margin-bottom: 20px">Sửa thông tin</button>
				</form>
			</div>
		</div>
		{{-- <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3" style="transform: translateY(10%);">			
			<img src="{{ asset('public/upload/AnhDaiDien/ctt.jpeg') }}" alt="" style="border-radius: 50%; height: 200px; width: 200px;">			
			<input type="file" id="myfile" name="myfile">
			<div class="avatar-uploader__text-container"><div class="avatar-uploader__text">Dụng lượng file tối đa 1 MB</div><div class="avatar-uploader__text">Định dạng:.JPEG, .PNG</div></div>
		</div>	 --}}	
	</div>
</div>
@endsection