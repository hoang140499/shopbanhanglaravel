@extends('index')
@section('content')
<div class="register">
	<div class="col-md-4 offset-md-4">
		<h2 style="border-bottom: 5px solid black;"><b>Form Register</b></h2>
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
		@if(session('thongbao-them'))
		<div class="alert alert-success">
			{{ session('thongbao-them') }}
		</div>
		@endif
		
		<form action="" method="post">
			{{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
			@csrf
			<div class="form-group">
				<label>Name</label>
				<input type="text" name="name" class="form-control" placeholder="Name">
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="email" name="email" class="form-control" placeholder="Email">
			</div>
			<div class="form-group">
				<label>Address</label>
				<input type="text" name="address" class="form-control" placeholder="Address">
			</div>
			<div class="form-group">
				<label>Phone</label>
				<input type="text" name="phone" class="form-control" placeholder="Phone">
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" name="password" class="form-control" placeholder="Password">
			</div>
			<button class="btn btn-success" style="width:100%; font-size: 25px">Register</button>			
		</form>
	</div>
</div>
@endsection