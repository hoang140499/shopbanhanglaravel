@extends('admin-crud.index')
@section('content')
<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Member</h1>
          <div class="pull-right mb-2">
            <a class="btn btn-primary" onClick="add()" href="javascript:void(0)">Thêm member</a>
          </div>
          @if ($message = Session::get('success'))
          <div class="alert alert-success">
            <p>{{ $message }}</p>
          </div>
          @endif
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="ajax-crud-datatable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Họ tên</th>
                      <th>Email</th>
                      <th>Sđt</th>
                      <th>Địa chỉ</th>
                      <th>Thao tác</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
          <!-- boostrap company model -->
  <div class="modal fade" id="company-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="CompanyModal"></h4>
        </div>
        <div class="modal-body">
          <form action="javascript:void(0)" id="CompanyForm" name="CompanyForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" id="id"> 
            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">Họ tên</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" id="name" name="name" placeholder="Họ tên" maxlength="50" required="">
              </div>
            </div>
            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" id="email" name="email" placeholder="Email" maxlength="50" required="">
              </div>
            </div>
            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">Sđt</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Sđt" maxlength="50" required="">
              </div>
            </div>
            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">Địa chỉ</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" id="address" name="address" placeholder="Địa chỉ" maxlength="50" required="">
              </div>
            </div>
            <div class="form-group">
              <label for="name" class="col-sm-4 control-label">Mật khẩu đăng nhập</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" id="password" name="password" placeholder="Mật khẩu" maxlength="50" required="">
              </div>
            </div>
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary" id="btn-save">Save changes
              </button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
        <!-- /.container-fluid -->
<script type="text/javascript">
  $(document).ready( function () {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    //mảng colum mặc định rồi dùng hàm index() bên controller để hiển thị vào trường columns
    $('#ajax-crud-datatable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ url('admin-crud/member') }}",
      columns: [
      { data: 'id', name: 'id' },
      { data: 'name', name: 'name' },
      { data: 'email', name: 'email' },
      { data: 'phone', name: 'phone' },
      { data: 'address', name: 'address' },
      // { data: 'created_at', name: 'created_at' },
      {data: 'action', name: 'action', orderable: false},
      ],
      order: [[0, 'asc']] // sắp xếp cột id tăng dân
    });
  });

  //mở modal add lên
  function add(){
    $('#CompanyForm').trigger("reset");
    $('#CompanyModal').html("Thêm thành viên");
    $('#company-modal').modal('show');
    $('#id').val('');
  }   

  function editFunc(id){
    $.ajax({
      type:"POST",
      url: "{{ url('admin-crud/edit-nhomhanghoa') }}",
      data: { id: id },
      dataType: 'json',
      success: function(res){
        $('#CompanyModal').html("Sửa nhóm hàng hóa");
        $('#company-modal').modal('show');
        $('#id').val(res.id);
        $('#TenNhom').val(res.TenNhom);
        $('#id_DM').val(res.id_DM);
      }
    });
  }  
  function deleteFunc(id){
    if (confirm("Bạn có chắc không?") == true) {
      var id = id;
// ajax
    $.ajax({
      type:"POST",
      url: "{{ url('admin-crud/delete-nhomhanghoa') }}",
      data: { id: id },
      dataType: 'json',
      success: function(res){
        var oTable = $('#ajax-crud-datatable').dataTable();
        oTable.fnDraw(false);
      }
    });
  }
}

//lưu vào csdl
$('#CompanyForm').submit(function(e) {
  e.preventDefault();
  var formData = new FormData(this);
  $.ajax({
    type:'POST',
    url: "{{ url('admin-crud/store-nhomhanghoa')}}",
    data: formData,
    cache:false,
    contentType: false,
    processData: false,
    success: (data) => {
      $("#company-modal").modal('hide');
      var oTable = $('#ajax-crud-datatable').dataTable();
      oTable.fnDraw(false);
      $("#btn-save").html('Submit');
      $("#btn-save"). attr("disabled", false);
    },
    error: function(data){
      console.log(data);
    }
  });
});
</script>
@endsection