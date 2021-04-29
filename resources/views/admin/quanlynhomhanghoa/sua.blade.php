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
	{{-- Hiển thị thông tin nhóm hàng hóa cần sửa --}}
	@foreach($nhomhanghoa as $value)
	<form action="{{ URL::to('admin/quanlynhomhanghoa/sua') }}/{{ $value->MaNhom }}" method="post" enctype="multipart/form-data">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<table width="auto" border="1">
			<tr>
				<td colspan="2"><div align="center">Sửa nhóm hàng hóa</div></td>
			</tr>
			<tr>
				<td>Mã Nhóm</td>
				<td><input type="text" name="MaNhom" value="{{ $value->MaNhom }}"></td>
			</tr>
			<tr>
				<td>Tên Nhóm</td>
				<td><input type="text" name="TenNhom" value="{{ $value->TenNhom }}"></td>
			</tr>
			<tr>
				<td>Mã Danh Mục</td>
				 <td>
					<select name="MaDanhMuc">
						{{-- <option value="{{ $value->MaDanhMuc }}"selected>{{$value->DanhMuc->TenDanhMuc}}</option> --}}
						{{-- Hiển thị các option của nhóm hàng hóa đang sửa --}}
						@foreach($danhmuc as $value1)
						<option value="{{ $value1->MaDanhMuc }} ">
							{{ $value1->MaDanhMuc }}-{{ $value1->TenDanhMuc }}
						</option>
						@endforeach
					</select>
					
					
				</td> 

			</tr>
			<tr>
				<td colspan="2"><div align="center"><button name="sua" value="Sửa">Sửa</button></div></td>
			</tr>
		</table>
	</form>	
	@endforeach
</div>

<div class="right">
	<table width="100%" border="1">
		<tr>

			<td>Mã Nhóm</td>
			<td>Tên Nhóm</td>
			<td>Mã Danh Mục</td>
			<td colspan="2">Quản lý</td>
		</tr>

		{{-- Hiển thị danh sách nhóm hàng hóa --}}
		@foreach($nhomhanghoaAll as $value)
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