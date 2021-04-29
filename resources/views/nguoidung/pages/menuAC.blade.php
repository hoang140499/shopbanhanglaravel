<div class="col-sm-2 col-md-2 col-lg-2 col-xl-2" style="background-color: #f3f3f3">
	<div class="menuAccount">
		<ul>
			<b><li>Xin chào: {{ Auth::guard('kh')->user()->HoTenKH }}</li></b>
			<a href="{{ route('getAccountProfile') }}"><li><i class="fas fa-user-circle"></i> Tài khoản của tôi</li></a>
			<a href="{{ route('getChangePass') }}"><li><i class="fas fa-key"></i> Đổi mật khẩu</li></a>
			<a href="{{ route('getAccountListOrder') }}"><li><i class="fas fa-list-alt"></i> Đơn hàng</li></a>
			<a href="{{ route('getAccountLikeProduct') }}"><li><i class="fas fa-star"></i>Sản phẩm yêu thích</li></a>
			<a href="{{ route('getComment') }}"><li><i class="fas fa-comment"></i>Bình luận của tôi</li></a>
			<a href="{{ route('logoutPages') }}"><li><i class="fas fa-sign-out-alt"></i> Đăng xuất</li></a>
		</ul>
	</div>
</div>