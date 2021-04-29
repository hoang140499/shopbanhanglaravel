<!DOCTYPE HTML>

<html>
	<head>
		<meta http-equiv="Content_Type" content="text/html; charset=urf-8" />
		<link rel = "stylesheet" type = "text/css" href = "{{ asset('/resources/css/admin/bootstrap.css') }}" />
		<link rel = "stylesheet" type = "text/css" href = "{{ asset('/resources/css/admin/css.css') }}" />
		<title>Quan tri</title>
	</head>
	<body>
		<div class="">
	@if(session('error'))
		<div class="alert alert-danger">
			{{ session('error') }}
		</div>
	@endif
		
			<form action="" method="post">
			{{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
			@csrf
				<div style="text-align:center">
					<input type="text" id="user" name="name" placeholder="User Name">
					<input type="text" id="user" name="email" placeholder="Email">
					<input type="text" id="user" name="phone" placeholder="Phone">
					<input type="text" id="user" name="address" placeholder="Address">
					<input type="text" id="pass" name="password" placeholder="Password">
					<input type="checkbox" name="remember" value="Remember Me"> Nhớ đăng nhập
					<button type="submit" class="btn btn-success" >Login</button>
					<a href="{{ route('login') }}"> Đăng nhập</a>
				</div>
			</form>
		</div>
	</body>
</html>
