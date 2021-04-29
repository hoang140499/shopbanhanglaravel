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

			<td>SoDonDH</td>
			<td>MSKH</td>
			<td>Ngày đặt</td>
			<td>Tổng tiền</td>
			<td>Trạng thái</td>
			<td colspan="2">Quản lý</td>
		</tr>
		@foreach($dathang as $value)
		<tr>
			<td>{{ $value->SoDonDH }} </td>
			<td>{{ $value->HoTenKH }} -{{ $value->ID_KH }} &nbsp</td>
			<td>{{ $value->NgayDH }} </td>
			<td>{{ number_format($value->TongTien) }}</td>
			<td>{{ $value->TrangThai }} </td>
			<td><a href="{{ asset('/admin/quanlydathang/sua/') }}/{{ $value->SoDonDH }}">Cập nhật</a></td>
			{{-- <td><a href="{{ asset('/admin/quanlydathang/xoa/') }}/{{ $value->SoDonDH }}">Xóa</a></td>	 --}}
		</tr>
		@endforeach
	</table>
</div>
@endsection