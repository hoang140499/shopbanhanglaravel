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

	@if(session('thongbao'))
		<div class="alert alert-success">
			{{ session('thongbao') }}
		</div>
	@endif
	{{-- Hiển thị thông tin danh mục cần sửa --}}
	@foreach($danhmuc as $value)
	<form action="{{ URL::to('admin/quanlydanhmuc/sua/') }}/{{ $value->MaDanhMuc }}" method="post" enctype="multipart/form-data">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<table width="auto" border="1">

			<tr>
				<td colspan="2"><div align="center">Sửa Danh Mục </div></td>
			</tr>

			<tr>
				<td>Mã Danh Mục</td>
				<td><input type="text" name="MaDanhMuc" value=' {{ $value->MaDanhMuc }}'></td>
			</tr>
			<tr>
				<td>Tên Danh Mục</td>
				<td><input type="text" name="TenDanhMuc" value='{{ $value->TenDanhMuc }}'></td>
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

			<td>Mã Danh Mục</td>
			<td>Tên Danh Mục</td>
			<td colspan="2">Quản lý</td>
		</tr>
			@foreach($danhmucall as $value)
		<tr>

			<td>{{ $value->MaDanhMuc }}</td>
			<td>{{ $value->TenDanhMuc }}</td>
			<td><a href="{{ asset('/admin/quanlydanhmuc/sua/') }}/{{ $value->MaDanhMuc }}">Sửa</a></td>
			<td><a href="{{ asset('/admin/quanlydanhmuc/xoa/') }}/{{ $value->MaDanhMuc }}">Xóa</a></td>	

		</tr>
			@endforeach
	</table>
</div>
@endsection