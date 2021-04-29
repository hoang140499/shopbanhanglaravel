@extends('admin.layout.index')
@section('content')
<div class="left">
	@if(session('thongbao-xoa'))
		<div class="alert alert-success">
			{{ session('thongbao-xoa') }}
		</div>
	@endif
	{{-- 	Hiển thị lỗi khi thêm --}}
	@if(count($errors)>0)
		<div class="alert alert-danger">
			@foreach($errors->all() as $err)
				{{ $err }}<br>
			@endforeach
		</div>
	@endif

	{{-- 	Hiển thị thông báo khi thêm thành công --}}
	@if(session('thongbao-them'))
		<div class="alert alert-success">
			{{ session('thongbao-them') }}
		</div>
	@endif
	<form action="{{ URL::to('admin/quanlynhomhanghoa/them') }}" method="post" enctype="multipart/form-data">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<table width="auto" border="1">
			<tr>
				<td colspan="2"><div align="center">Thêm Nhóm Hàng Hòa</div></td>
			</tr>
			<tr>
				<td>Mã Nhóm</td>
				<td><input type="text" name="MaNhom"></td>
			</tr>
			<tr>
				<td>Tên Nhóm</td>
				<td><input type="text" name="TenNhom"></td>
			</tr>
			<tr>
				<td>Mã Danh Mục</td>

				 <td>
					<select name="MaDanhMuc">
						{{-- Hiển thị danh sách các danh mục trong nhóm hàng hóa --}}
						@foreach($danhmuc as $value)
						<option value="{{ $value->MaDanhMuc }}">
							{{ $value->MaDanhMuc }}-{{ $value->TenDanhMuc }}
						</option>				
						@endforeach
					</select>
				</td> 

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

			<td>Mã Nhóm</td>
			<td>Tên Nhóm</td>
			<td>Tên Danh Mục</td>
			<td colspan="2">Quản lý</td>
		</tr>

		{{-- Hiển thị danh sách nhóm hàng hóa --}}
		@foreach($nhomhanghoa as $value)
		<tr>
			<td>{{ $value->MaNhom }}</td>
			<td>{{ $value->TenNhom }}</td>
			<td>{{ $value->MaDanhMuc }}-{{ $value->DanhMuc->TenDanhMuc}}</td>			
			<td><a href="{{ asset('/admin/quanlynhomhanghoa/sua/') }}/{{ $value->MaNhom }}">Sửa</a></td>
			<td><a href="{{ asset('/admin/quanlynhomhanghoa/xoa/') }}/{{ $value->MaNhom }}">Xóa</a></td>	
		</tr>
		@endforeach

	</table>
</div>
@endsection