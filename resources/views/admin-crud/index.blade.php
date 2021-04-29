<!DOCTYPE html>
<html lang="en">

<head>
  <title>SB Admin 2 - Tables</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- CRUD-AJAX-DATATABLE --}}
  {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" > --}}
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
  <script src="https://cdn.datatables.net/plug-ins/1.10.22/sorting/datetime-moment.js"></script>
{{--   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}
  {{-- <link  href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

  <!-- TEMPLATE -->
  <link href="{{ asset('resources/views/admin-crud/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="{{ asset('resources/views/admin-crud/css/sb-admin-2.min.css') }}" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="{{ asset('resources/views/admin-crud/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

</head>
<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    @include('admin-crud.includes.slidebar')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        @include('admin-crud.includes.topbar')        
        @yield('content')
      </div>
      <!-- End of Main Content -->
      {{-- @include('admin-crud.includes.footer') --}}
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->
  @include('admin-crud.includes.btn-to-top')
  @include('admin-crud.includes.logoutModal')

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('resources/views/admin-crud/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('resources/views/admin-crud/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('resources/views/admin-crud/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('resources/views/admin-crud/js/sb-admin-2.min.js') }}"></script>

  <!-- Page level plugins -->
  <script src="{{ asset('resources/views/admin-crud/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('resources/views/admin-crud/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('resources/views/admin-crud/js/demo/datatables-demo.js') }}"></script>

</body>

</html>
