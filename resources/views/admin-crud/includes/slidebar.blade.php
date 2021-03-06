
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('trangchuCrud') }}">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-heading"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
        Quản lý
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Login Screens:</h6>
            <a class="collapse-item" href="login.html">Login</a>
            <a class="collapse-item" href="register.html">Register</a>
            <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item" href="404.html">404 Page</a>
            <a class="collapse-item" href="blank.html">Blank Page</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="{{ asset('admin-crud/thongke') }}">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Thống kê</span></a>
      </li>
{{--       <li class="nav-item">
        <a class="nav-link" href="{{ asset('admin-crud/bieudo') }}">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Biểu đồ</span></a>
      </li> --}}

      <!-- Nav Item - Tables -->
      <li class="nav-item active">
        <a class="nav-link" href="{{ asset('admin-crud/danhmuc') }}">        
          <i class="fas fa-coins"></i>
          <span>Danh mục</span></a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="{{ asset('admin-crud/nhomhanghoa') }}">
          <i class="fab fa-buffer"></i>
          <span>Nhóm hàng hóa</span></a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="{{ asset('admin-crud/hanghoa') }}">
          <i class="fas fa-coffee"></i>
          <span>Hàng hóa</span></a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="{{ asset('admin-crud/donhang') }}">
          <i class="fas fa-file-invoice-dollar"></i>
          <span>Đơn hàng</span></a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="{{ asset('admin-crud/member') }}">
          <i class="fas fa-users"></i>
          <span>Member</span></a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="{{ asset('admin-crud/khachhang') }}">
          <i class="fas fa-users"></i>
          <span>Khách hàng</span></a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="{{ asset('admin-crud/comment') }}">
          <i class="fas fa-comment"></i>
          <span>Bình luận</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar