<!DOCTYPE HTML>

<html>
	<head>
		<meta http-equiv="Content_Type" content="text/html; charset=urf-8" />
		<link rel = "stylesheet" type = "text/css" href = "{{ asset('/resources/css/admin/bootstrap.css') }}" />
		<link rel = "stylesheet" type = "text/css" href = "{{ asset('/resources/css/admin/css.css') }}" />
		<title>Quan tri</title>
	</head>
	<body>
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
		
			<form action="{{ route('login') }}" method="post">
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
				<a href="{{ route('register') }}"> Đăng kí</a>

			</form>
		</div>

	</body>
</html>
