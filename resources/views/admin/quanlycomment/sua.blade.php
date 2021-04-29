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
	@if(session('thongbao-sua'))
		<div class="alert alert-success">
			{{ session('thongbao-sua') }}
		</div>
	@endif
	@if(session('thongbao-xoa'))
		<div class="alert alert-danger">
			{{ session('thongbao-xoa') }}
		</div>
	@endif
	@foreach($dathang as $value)
	<form action="{{-- {{ URL::to('admin/quanlydathang/sua') }}/{{ $value->SoDonDH }} --}}" method="post" enctype="multipart/form-data">
		@csrf
		<table width="auto" border="1">
			<tr>
				<td colspan="2"><div align="center">Xác nhận trạng thái ĐH số {{ $value->SoDonDH }} &nbsp</div></td>
			</tr>
				<td>Trạng thái</td>
				{{-- <td><input type="text" name="TrangThai" value="{{ $value->TrangThai }}"></td> --}}
				<td>
					<select name="TrangThai" id="">
						<option value="ChuaXem">ChuaXem</option>
						<option value="XacNhan">XacNhan</option>
						<option value="HoanThanh">HoanThanh</option>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2"><div align="center"><button name="them" value="Thêm">Sửa</button></div></td>
			</tr>
		</table>
	</form>	
	@endforeach
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
		@foreach($dathangAll as $value)
		<tr>
			<td>{{ $value->SoDonDH }} </td>
			<td>{{ $value->HoTenKH }} -{{ $value->MSKH }} &nbsp</td>
			<td>{{ $value->NgayDH }} </td>
			<td>{{ number_format($value->TongTien) }}</td>
			<td>{{ $value->TrangThai }} </td>
			<td><a href="{{ asset('/admin/quanlydathang/sua/') }}/{{ $value->SoDonDH }}">Cập nhật</a></td>
			{{-- <td><a href="{{ asset('/admin/quanlydathang/xoa/') }}/{{ $value->SoDonDH }}">Xóa</a></td> --}}	
		</tr>
		@endforeach
	</table>
</div>
@endsection