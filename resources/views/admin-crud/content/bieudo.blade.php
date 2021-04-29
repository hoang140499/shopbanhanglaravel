@extends('admin-crud.index')
@section('content')
<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Thống kê doanh thu năm 2021</h1>
          @if ($message = Session::get('success'))
          <div class="alert alert-success">
            <p>{{ $message }}</p>
          </div>
          @endif
          <!-- DataTales Example -->
        </div>
        
        <div id="chart" style="width: 80%;margin: 0 auto;">
            {!! $chart->container() !!}
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
        {!! $chart->script() !!}
          <!-- boostrap company model -->

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
      ajax: "{{ url('admin-crud/nhomhanghoa') }}",
      columns: [
      { data: 'id', name: 'id' },
      { data: 'TenNhom', name: 'TenNhom' },
      // { data: 'id_DM', name: 'id_DM' },
      { data: 'danhmuc.TenDanhMuc', name: 'danhmuc.TenDanhMuc' },
      // { data: 'created_at', name: 'created_at' },
      {data: 'action', name: 'action', orderable: false},
      ],
      order: [[0, 'asc']] // sắp xếp cột id tăng dân
    });
  });

  //mở modal add lên
  function add(){
    $('#CompanyForm').trigger("reset");
    $('#CompanyModal').html("Thêm nhóm hàng hóa");
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