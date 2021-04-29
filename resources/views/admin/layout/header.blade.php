		<div class="header">
			<h3 style="text-align:center; color:blue ">Quản trị nội dung website</h3>
			<div style="text-align:center">
				<h3>Welcome</h3>
				@if(Auth::guard('member')->check())
					Xin chào: {{ Auth::guard('member')->user()->name }} .<br>
					<a href="{{ route('logout') }}">Logout</a>
				@endif
			</div>
		</div>