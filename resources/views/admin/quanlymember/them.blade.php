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
				{{ $err }}<br>
			@endforeach
		</div>
	@endif
	@if(session('thongbao-them'))
		<div class="alert alert-success">
			{{ session('thongbao-them') }}
		</div>
	@endif
	<form action="{{ URL::to('admin/quanlymember/them') }}" method="post" enctype="multipart/form-data">
		@if(session('create'))
			<div class="alert alert-success">
				{{ session('create') }}
			</div>
		@endif
		@if(session('delete'))
			<div class="alert alert-success">
				{{ session('delete') }}
			</div>
		@endif
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<table width="auto" border="1">
			<tr>
				<td colspan="2"><div align="center">Thêm Member</div></td>
			</tr>
			<tr>
				<td>Name</td>
				<td><input type="text" id="user" name="name" placeholder="Name"></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type="text" id="user" name="email" placeholder="Email"></td>
			</tr>
			<tr>
				<td>Phone</td>
				<td><input type="text" id="user" name="phone" placeholder="Phone"></td>
			</tr>
			<tr>
				<td>Address</td>
				<td><input type="text" id="user" name="address" placeholder="Address"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="text" id="pass" name="password" placeholder="Password"></td>
			</tr>
			<tr>
				<td colspan="2"><div align="center"><button type="submit">Thêm</button></div></td>
			</tr>
		</table>
	</form>	

</div>

<div class="right">
	<table width="100%" border="1">
		<tr>
			<td>ID</td>
			<td>Name</td>
			<td>Email</td>
			<td>Phone</td>
			<td>Address</td>
			<td>Password</td>
			<td colspan="2">Quản lý</td>
		</tr>

		@foreach($member as $value)
		<tr>
			<td>{{ $value->id }}</td>
			<td>{{ $value->name }}</td>
			<td>{{ $value->email }}</td>
			<td>{{ $value->phone }}</td>
			<td>{{ $value->address }}</td>
			<td>{{ $value->password }}</td>
			<td><a href="{{ asset('/admin/quanlymember/sua/') }}/{{ $value->id }}">Sửa</a></td>
			<td><a href="{{ asset('/admin/quanlymember/xoa/') }}/{{ $value->id }}">Xóa</a></td>	
		</tr>
		@endforeach
	</table>
</div>
@endsection