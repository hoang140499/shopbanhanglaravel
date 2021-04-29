
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
	<!-- font awesome -->
	<script src="https://kit.fontawesome.com/3b9396b8d5.js" crossorigin="anonymous"></script>
	<meta http-equiv="Content_Type" content="text/html; charset=urf-8" />
{{-- 	<meta name="csrf-token" content="{{ csrf_token() }}"> --}}
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel = "stylesheet" type = "text/css" href = "{{asset('resources/css/nguoidung/bootstrap.css')}}" />
	<link rel = "stylesheet" type = "text/css" href = "{{asset('resources/css/nguoidung/css.css')}}" />
	<link rel = "stylesheet" type = "text/css" href = "{{asset('resources/css/nguoidung/lightbox.min.css')}}" />


	<!-- JavaScript -->
	<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

	<!-- CSS -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
	<!-- Default theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
	<!-- Semantic UI theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
	<!-- Bootstrap theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.rtl.min.css"/>
	<!-- Default theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.rtl.min.css"/>
	<!-- Semantic UI theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.rtl.min.css"/>
	<!-- Bootstrap theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css"/>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	
	<title>Web bán hàng</title>
</head>
<body>  
	<div class = "main" style="">

		@include('header')
		<div class="than">
			@yield('content')
		</div>
		@include('footer')


	</div>
	{{-- Alert --}}
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	
	<script type="text/javascript" src="{{asset('resources/js/nguoidung//bootstrap.js')}}"></script>
	<script type="text/javascript" src="{{asset('resources/js/nguoidung/lightbox-plus-jquery.min.js')}}"></script>
	{{-- <script type="text/javascript" src="{{asset('resources/js/nguoidung/js.js')}}"></script> --}} 
	{{-- Ajax  --}}
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>       
	<!-- JS, Popper.js, and jQuery -->
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>