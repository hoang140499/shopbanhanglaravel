@extends('admin.layout.index')
@section('content')
<div class="left">
	@if(count($errors)>0)
		<div class="alert alert-danger">
			@foreach($errors->all() as $err)
				{{ $err }}<br>
			@endforeach
		</div>
	@endif
{{-- 	@if(session('thongbao-them'))
		<div class="alert alert-success">
			{{ session('thongbao-them') }}
		</div>
	@endif
	<form action="{{ URL::to('admin/quanlydanhmuc/them') }}" method="post" enctype="multipart/form-data">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<table width="auto" border="1">
			<tr>
				<td colspan="2"><div align="center">Thêm Danh Mục</div></td>
			</tr>
			<tr>
				<td>Mã Danh Mục</td>
				<td><input type="text" name="MaDanhMuc"></td>
			</tr>
			<tr>
				<td>Tên Danh Mục</td>
				<td><input type="text" name="TenDanhMuc"></td>
			</tr>
			<tr>
				<td colspan="2"><div align="center"><button name="them" value="Thêm">Thêm</button></div></td>
			</tr>
		</table>
	</form>	 --}}

</div>

<div class="right">
	@if(session('thongbao-xoa'))
		<div class="alert alert-success">
			{{ session('thongbao-xoa') }}
		</div>
	@endif
	<table width="100%" border="1">
		<tr>

			<td>SoDonDH</td>
			<td>MSHH</td>
			<td>SoLuong</td>
			<td>GiaDatHang</td>
			{{-- <td colspan="2">Quản lý</td> --}}
		</tr>
		@foreach($chitietdathang as $value)
		<tr>
			<td>{{ $value->SoDonDH }}</td>
			<td>{{ $value->TenHH }} - {{ $value->MSHH }}</td>
			<td>{{ $value->SoLuong }}</td>
			<td>{{ number_format($value->GiaDatHang) }} </td>
{{-- 			<td><a href="{{ asset('/admin/quanlychitietdathang/sua/') }}/{{ $value->MSKH }}">Sửa</a></td>
			<td><a href="{{ asset('/admin/quanlychitietdathang/xoa/') }}/{{ $value->MSKH }}">Xóa</a></td>	 --}}
		</tr>
		@endforeach
	</table>
</div>
@endsection