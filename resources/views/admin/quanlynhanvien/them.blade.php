@extends('admin.layout.index')
@section('content')
<div class="left">
	@if(session('thongbao-xoa'))
		<div class="alert alert-success">
			{{ session('thongbao-xoa') }}
		</div>
	@endif
	@if(count($errors)>0)
		<div class="alert alert-danger">
			@foreach($errors->all() as $err)
				{{ $err }} <br>
			@endforeach
		</div>
	@endif

	@if(session('thongbao-them'))
		<div class="alert alert-success">
			{{ session('thongbao-them') }}
		</div>
	@endif
	<form action="{{ URL::to('admin/quanlynhanvien/them') }}" method="post" enctype="multipart/form-data">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<table width="auto" border="1">
			<tr>
				<td colspan="2"><div align="center">Thêm Danh Mục</div></td>
			</tr>
			<tr>
				<td>Mã nhân viên</td>
				<td><input type="text" name="MaNV"></td>
			</tr>
			<tr>
				<td>Họ tên</td>
				<td><input type="text" name="HoTenNV"></td>
			</tr>
			<tr>
				<td>Chức vụ</td>
				<td><input type="text" name="ChucVu"></td>
			</tr>
			<tr>
				<td>Địa chỉ</td>
				<td><input type="text" name="DiaChi"></td>
			</tr>
			<tr>
				<td>Số điện thoại</td>
				<td><input type="text" name="SoDienThoai"></td>
			</tr>
			<tr>
				<td colspan="2"><div align="center"><button name="them" value="Thêm">Thêm</button></div></td>
			</tr>
		</table>
	</form>	
</div>

<div class="right">

	<table width="100%" border="1">
		<tr>
			<td>Mã nhân viên</td>
			<td>Họ tên nhân viên</td>
			<td>Chức vụ</td>
			<td>Địa chỉ</td>
			<td>Số điện thoại</td>
			<td colspan="2">Quản lý</td>
		</tr>

		@foreach($nhanvien as $value)
		<tr>
			<td>{{ $value->MSNV }}</td>
			<td>{{ $value->HoTenNV }}</td>
			<td>{{ $value->ChucVu }}</td>
			<td>{{ $value->DiaChi }}</td>
			<td>{{ $value->SoDienThoai }}</td>
			<td><a href="{{ asset('admin/quanlynhanvien/sua/') }}/{{ $value->MSNV }}">Sửa</a></td>
			<td><a href="{{ asset('admin/quanlynhanvien/xoa/') }}/{{ $value->MSNV }}">Xóa</a></td>	
		</tr>
		@endforeach
	</table>
</div>
@endsection