@extends('admin.layout.index')
@section('content')
<div class="left">
	<form action="" method="post" enctype="multipart/form-data">
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
				<td colspan="2"><div align="center"><button name="them" value="Thêm">Sửa</button></div></td>
			</tr>
		</table>
	</form>	
</div>

<div class="right">

	<table width="100%" border="1">
		<tr>

			<td>Mã Danh Mục</td>
			<td>Tên Danh Mục</td>
			<td colspan="2">Quản lý</td>
		</tr>

		<tr>

			<td>aaa</td>
			<td>aaa</td>
			<td><a href="">Sửa</a></td>
			<td><a href="">Xóa</a></td>	
		</tr>

	</table>
</div>
@endsection