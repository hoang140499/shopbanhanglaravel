
<!DOCTYPE HTML>

<html>
<head>
	<meta http-equiv="Content_Type" content="text/html; charset=urf-8" />
	<link rel = "stylesheet" type = "text/css" href = "{{ asset('/resources/css/admin/bootstrap.css') }}" />
	<link rel = "stylesheet" type = "text/css" href = "{{ asset('/resources/css/admin/css.css') }}" />
	<title>Quan tri</title>

</head>
<body>

	@if(session('success'))
		<div class="alert alert-success">
			{{ session('success') }}
		</div>
	@endif
	<div class="wrapper">
		@include('admin.layout.header')
		@include('admin.layout.menu')
		<div class="content">
			@yield('content')
		</div>
	</div>


</body>
</html>
