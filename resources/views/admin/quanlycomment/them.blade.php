@extends('admin.layout.index')
@section('content')
<div class="left">
{{-- 	<form action="" method="post" enctype="multipart/form-data">
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

			<td>ID</td>
			<td>ID_Users</td>
			<td>MSHH</td>
			<td>Nội dung</td>
			<td colspan="2">Quản lý</td>
		</tr>
		@foreach($comment as $value)
		<tr>
			<td>{{ $value->ID }} </td>
			<td>{{ $value->ID_Users }}</td>
			<td>{{ $value->MSHH }}-{{ $value->hanghoa->TenHH }} </td>
			<td>{{ $value->NoiDung }} </td>
{{-- 			<td><a href="{{ asset('/admin/quanlycomment/sua/') }}/{{ $value->SoDonDH }}">Cập nhật</a></td> --}}
			<td><a href="{{ asset('/admin/quanlycomment/xoa/') }}/{{ $value->ID }}">Xóa</a></td>	
		</tr>
		@endforeach
	</table>
</div>
@endsection