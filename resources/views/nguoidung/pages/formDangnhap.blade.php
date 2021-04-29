@extends('index')
@section('content')
<div class="login">
	<div class="col-md-4 offset-md-4">
		<h2 style="border-bottom: 5px solid black"><b>Form Login</b></h2>
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
		
		<form action="{{ route('loginPages') }}" method="post">
			{{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
			@csrf
			<div class="form-group">
				<label>Email</label>
				<input type="email" name="email" class="form-control" placeholder="Email">
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" name="password" class="form-control" placeholder="Password">
			</div>
			<button class="btn btn-success">Login</button>
			<input type="checkbox" name="remember" value="Remember Me"> Nhớ đăng nhập
			<a href="{{ route('registerPages') }}"> Đăng kí</a>
		</form>
	</div>
</div>
@endsection