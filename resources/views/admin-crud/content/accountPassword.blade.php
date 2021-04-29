@extends('admin-crud.index')
@section('content')
<div class="container-fluid">
	<div class="row" >
		<div class="col-sm-10 col-md-10 col-lg-10 col-xl-10">			
			<b><h2>Đổi mật khẩu</h2></b>
			@if(session('thongbao-sua'))
				<div class="alert alert-success">
					{{ session('thongbao-sua') }}
				</div>
			@endif
			@if(session('error'))
				<div class="alert alert-danger">
					{{ session('error') }}
				</div>
			@endif
			<div class="passwordAccount">
				<form action="" method="post">
					@csrf
					 <div class="form-row">
					    <div class="form-group col-md-6">					    	
					       	<label for="inputPassword4">Mật khẩu hiện tại</label>
					      	<input type="password" class="form-control" id="inputPassword4" placeholder="" value="" name="old-password" required="">
					    </div>
					</div>
					<div class="form-row">
					    <div class="form-group col-md-6">
					    	<label for="inputPassword4">Mật khẩu mới</label>
					     	<input type="password" class="form-control" id="inputPassword4" placeholder="" value="" name="new-password" required="">
					    </div>
					</div>
					<div class="form-row">
					    <div class="form-group col-md-6">
					      	<label for="inputPassword4">Xác nhận mật khẩu</label>
					      	<input type="password" class="form-control" id="inputPassword4" placeholder="" value="" name="retry-password" required="">
					    </div>
					</div>
					<div class="form-row">
					  	<button type="submit" class="btn btn-success" style="">Xác nhận</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection