@extends('admin.layout.index')
@section('content')
<div class="left">
	@if(session('thongbao-xoa'))
	<div class="alert alert-success">
		{{ session('thongbao-xoa') }}
	</div>
	@endif

	@if(count($errors) > 0)
	<div class="alert alert-danger">
		@foreach($errors->all() as $err)
		{{ $err }}<br>
		@endforeach
	</div>
	@endif

	@if(session('thongbao-sua'))
	<div class="alert alert-success">
		{{ session('thongbao-sua') }}
	</div>
	@endif
	{{-- Hiển thị thông tin danh mục cần sửa --}}
	@foreach($khachhang as $value)
	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<table width="auto" border="1">
			<tr>
				<td colspan="2"><div align="center">Sửa Khách Hàng</div></td>
			</tr>

			<tr>
				<td>ID Khách Hàng</td>
				<td><input type="text" name="id" value='{{ $value->id }}'></td>
			</tr>
			<tr>
				<td>Họ Tên KH</td>
				<td><input type="text" name="HoTenKH" value='{{ $value->HoTenKH }}'></td>
			</tr>
			<tr>
				<td>Địa chỉ</td>
				<td><input type="text" name="DiaChi" value='{{ $value->DiaChi }}'></td>
			</tr>
			<tr>
				<td>SĐT</td>
				<td><input type="text" name="SoDienThoai" value='{{ $value->SoDienThoai }}'></td>
			</tr>
			<tr>
				<td colspan="2"><div align="center"><button name="them" value="Thêm">Sửa</button></div></td>
			</tr>
		</table>
	</form>	
	@endforeach
</div>

<div class="right">

	<table width="100%" border="1">
		<tr>
			<td>ID_KH</td>
			<td>Họ tên KH</td>
			<td>Địa chỉ</td>
			<td>Sđt</td>
			<td colspan="2">Quản lý</td>
		</tr>

		@foreach($khachhangAll as $value)
		<tr>
			<td>{{ $value->id }}</td>
			<td>{{ $value->HoTenKH }}</td>
			<td>{{ $value->DiaChi }}</td>
			<td>{{ $value->SoDienThoai}}</td>
			<td><a href="{{ asset('/admin/quanlykhachhang/sua/') }}/{{ $value->id }}">Sửa</a></td>
			<td><a href="{{ asset('/admin/quanlykhachhang/xoa/') }}/{{ $value->id }}">Xóa</a></td>	
		</tr>
		@endforeach
	</table>
</div>
@endsection