@extends('index')
@section('content')
<div class="Account">
	<div class="row" >
		@include('nguoidung.pages.menuAC')
		<div class="col-sm-10 col-md-10 col-lg-10 col-xl-10">
			
			<b><h2>Đổi mật khẩu</h2></b>
			<div class="passwordAccount">
				<form action="{{ route('postChangePass') }}" method="post">
					@csrf
					 <div class="row d-flex justify-content-center">
					    <div class="form-group col-md-6">
					    	@if(session('success'))
								<div class="alert alert-success">
									{{ session('success') }}
								</div>
							@endif
					    	@if(count($errors)>0)
								<div class="alert alert-danger">
									@foreach($errors->all() as $err)
										{{ $err }}<br>
									@endforeach
								</div>
							@endif
					    	@if(session('error'))
								<div class="alert alert-danger">
									{{ session('error') }}
								</div>
							@endif
					       	<label for="inputPassword4">Mật khẩu hiện tại</label>
					      	<input type="password" class="form-control" id="inputPassword4" placeholder="" value="" name="old-password">
					    </div>
					</div>
					<div class="row d-flex justify-content-center">
					    <div class="form-group col-md-6">
					    	<label for="inputPassword4">Mật khẩu mới</label>
					     	<input type="password" class="form-control" id="inputPassword4" placeholder="" value="" name="new-password">
					    </div>
					</div>
					<div class="row d-flex justify-content-center">
					    <div class="form-group col-md-6">
					      	<label for="inputPassword4">Xác nhận mật khẩu</label>
					      	<input type="password" class="form-control" id="inputPassword4" placeholder="" value="" name="retry-password">
					    </div>
					</div>
					<div class="row d-flex justify-content-center">
					  	<button type="submit" class="btn btn-success" style="">Xác nhận</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection