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
	@if(session('thongbao-sua'))
		<div class="alert alert-success">
			{{ session('thongbao-sua') }}
		</div>
	@endif
	@foreach($member as $value)
	<form action="{{ URL::to('admin/quanlymember/sua/') }}/{{ $value->id }}" method="post" enctype="multipart/form-data">
		@if(session('update'))
			<div class="alert alert-success">
				{{ session('update') }}
			</div>
		@endif
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<table width="auto" border="1">

			<tr>
				<td colspan="2"><div align="center">Sửa Member</div></td>
			</tr>
			<tr>
				<td>Name</td>
				<td><input type="text" id="user" name="name" placeholder="Name" value="{{ $value->name }}"></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type="text" id="user" name="email" placeholder="Email" value="{{ $value->email }}"></td>
			</tr>
			<tr>
				<td>Phone</td>
				<td><input type="text" id="user" name="phone" placeholder="Phone" value="{{ $value->phone }}"></td>
			</tr>
			<tr>
				<td>Address</td>
				<td><input type="text" id="user" name="address" placeholder="Address" value="{{ $value->address }}"></td>
			</tr>
			<tr>
				<td colspan="2"><div align="center"><button type="submit">Sửa</button></div></td>
			</tr>
			
		</table>
	</form>	
	@endforeach
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

		@foreach($memberAll as $value)
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