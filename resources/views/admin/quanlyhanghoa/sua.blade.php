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
	@if(session('thongbao-sua'))
		<div class="alert alert-success">
			{{ session('thongbao-sua') }}
		</div>
	@endif
	@foreach($hanghoa as $value)
	<form action="{{ URL::to('admin/quanlyhanghoa/sua') }}/{{ $value->MSHH }}" method="post" enctype="multipart/form-data">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<table width = "auto" border="1">
			<tr>
				<td colspan="2"><div align="center">Sửa chi tiết sản phẩm</div></td>
			</tr>
			<tr>
				<td>Mã hàng hóa</td>
				<td><input type="text" name="MSHH" value="{{ $value->MSHH }}"></td>
			</tr>
			<tr>
				<td>Tên hàng hóa</td>
				<td><input type="text" name="TenHH" value="{{ $value->TenHH }}"></td>
			</tr>
			<tr>
				<td>Giá</td>
				<td><input type="text" name="Gia" value="{{ $value->Gia }}"></td>
			</tr>
			<tr>
				<td>Số lượng</td>
				<td><input type="text" name="SoLuongHang" value="{{ $value->SoLuongHang }}"></td>
			</tr>
			<tr>
				<td>Mã nhóm</td>
				<td>
					<select name="MaNhom">
						@foreach($nhomhanghoa as $value)
						<option value="{{ $value->MaNhom }}">{{ $value->TenNhom }}</option>	
						@endforeach
					</select>
				</td>

			</tr>
			<tr>
				<td>Hình ảnh</td>
				<td><input type="file" name="Hinh"></td>
			</tr>
			<tr>
				<td>Hình ảnh minh hoa</td>
				<td><input type="file" name="HinhMinhHoa[]" multiple></td>
			</tr>
			<tr>
				<td>Mô tả</td>
				<td>
					<textarea name="MoTaHH" cols="80" rows="20">{{ $value->MoTaHH }}
					</textarea>
				</td>
			</tr>
			<tr>
				<td colspan="2"><div align="center"><button name="sua" value="Thêm">Sửa</button></div></td>
			</tr>
		</table>
	</form>
	@endforeach
</div>

<div class="right">
	<table width="auto" border="1">
		<tr>
			<td>Mã hàng hóa</td>
			<td>Tên hàng hóa</td>
			<td>Giá</td>
			<td>Số lượng</td>
			<td>Mã nhóm</td>
			<td>Hình ảnh</td>
			<td>Hình minh họa</td>
			<td>Mô tả</td>
			<td colspan="2">Quản lý</td>
		</tr>
		@foreach($hanghoaAll as $value)
		<tr>
			<td>{{ $value->MSHH }}</td>
			<td>{{ $value->TenHH }}</td>
			<td>{{ $value->Gia }}</td>
			<td>{{ $value->SoLuongHang }}</td>
			<td>{{ $value->MaNhom }}</td>
			<td><img src="{{ URL::to('upload/AnhSanpham/') }}/{{ $value->Hinh }}" width="60" height="60" /></td>			
			{{-- hiển thị ảnh minh họa --}}
			<td>
				<?php
				$a = $value->HinhMinhHoa;
				$a = explode(" ",$a);
				$count = count($a)-1;
				for ($i=0; $i<$count; $i++ ){ 
					if($count>0){
						?>
						<img src="{{ URL::to('upload/AnhMinhhoa/') }}/{{ $a[$i] }}"width="60" height="60" />
						<?php 
					}
				}
				?>
			</td>
			{{-- đóng hiển thị ảnh minh họa --}}
			<td>{{ $value->MoTaHH }}</td>
			<td><a href="{{ asset('admin/quanlyhanghoa/sua') }}/{{ $value->MSHH }}">Sửa</a></td>
			<td><a href="{{ asset('admin/quanlyhanghoa/xoa') }}/{{ $value->MSHH }}">Xóa</a></td>
		</tr>
		@endforeach
	</table>
</div>
@endsection