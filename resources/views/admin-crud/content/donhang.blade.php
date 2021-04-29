@extends('admin-crud.index')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Đơn hàng</h1>
          {{-- <div class="pull-right mb-2">
            <a class="btn btn-success" onClick="add()" href="javascript:void(0)">Thêm nhóm hàng hóa</a>
          </div> --}}
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
                      <th>Khách hàng</th>
                      <th>Sđt</th>
                      <th>Ngày đặt</th>
                      <th>Tổng SL</th>
                      <th>Tổng tiền</th>
                      <th>Trạng thái</th>
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
                    <label for="name" class="col-sm-3 control-label">Trạng thái</label>
                    <div class="col-sm-12">
                     {{--  <input type="text" class="form-control" id="id_DM" name="id_DM" placeholder="Tên" maxlength="50" required=""> --}}
                     <select class="form-control" id="TrangThai" name="TrangThai">
                      <option value="ChuaXem" selected>ChuaXem</option>               
                      <option value="XacNhan">XacNhan</option>                
                      <option value="HoanThanh">HoanThanh</option>                
                    </select>
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


      <!-- boostrap detail model -->
      <div class="modal fade" id="detail-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="DetailModal"></h4>
            </div>
            <div class="modal-body">
              <form action="javascript:void(0)" id="DetailForm" name="DetailForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id">
                <div class="form-group">
                  <label for="name" class="col-sm-3 control-label">Trạng thái</label>
                  <div class="col-sm-12">
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="table_id" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Hình</th>
                              <th>Tên</th>
                              <th>Số lượng</th>
                              <th>Đơn giá</th>
                            </tr>
                          </thead>
                          <tbody>
                        
                           
                           
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-offset-2 col-sm-10">
                  Ngày đặt: 
                 <input type="text" id="NgayDH" name="NgayDH" disabled>
                </div>
              </form>
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
      ajax: "{{ url('admin-crud/donhang') }}",
      columns: [
      { data: 'id', name: 'id' },
      { data: 'khachhang.HoTenKH', name: 'khachhang.HoTenKH' },
      { data: 'khachhang.SoDienThoai', name: 'khachhang.SoDienThoai' },
      { data: 'NgayDH', name: 'NgayDH' },
      { data: 'TongSoLuong', name: 'TongSoLuong' },
      { data: 'TongTien', name: 'TongTien', render: $.fn.dataTable.render.number(',', '.', '') },
      { data: 'TrangThai', name: 'TrangThai' },
      // { data: 'created_at', name: 'created_at' },
      {data: 'action', name: 'action', orderable: false},
      ],
      order: [[0, 'asc']] // sắp xếp cột id tăng dân
    });
  });

  //mở modal add lên
  // function add(){
  //   $('#CompanyForm').trigger("reset");
  //   $('#CompanyModal').html("Thêm nhóm hàng hóa");
  //   $('#company-modal').modal('show');
  //   $('#id').val('');
  // }   

  function editFunc(id){
    $.ajax({
      type:"POST",
      url: "{{ url('admin-crud/edit-donhang') }}",
      data: { id: id },
      dataType: 'json',
      success: function(res){
        $('#CompanyModal').html("Cập nhật đơn hàng");
        $('#company-modal').modal('show');
        $('#id').val(res.id);
      }
    });
  } 
  function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
  }
  function detailFunc(id){
    $.ajax({
      type:"POST",
      url: "{{ url('admin-crud/detail-donhang') }}",
      data: { id: id },
      dataType: 'json',
      success: function(res){
        $('#DetailForm').trigger("reset");
        $('#DetailModal').html("Chi tiết đơn hàng");
        $('#detail-modal').modal('show');
        $('#id_DH').val(res.id_DH);
        
        // console.log(res.id_HH);
        var columns;
        var NgayDH;
        $.each(res, function (i, item) {             
          columns +=    "<tr><td>" + item.id_HH + "</td><td><img src={{ URL::to('public/upload/AnhSanPham/') }}/"+item.Hinh+" style=width:100px></td><td>" + item.TenHH + "</td><td>" + item.SoLuong + "</td><td>" + formatNumber(item.GiaDatHang) + "</td></tr>";
          NgayDH = item.NgayDH;
        });
        $('#table_id tbody').empty();
        $('#table_id tbody').append(columns);
        $('#NgayDH').val(NgayDH);
        // for (var i = 0; i < res.length; i++) {
        //    console.log(res[i].id_HH);
        //    $('#table_id tbody').append(
        //        "<tr><td>" + res[i].id_HH + "</td><td>" + res[i] + "</td><td>" + res[i].TenHH + "</td><td>" + res[i].SoLuong + "</td><td>" + res[i].GiaDatHang + "</td></tr>");
        //  }

        //   //  return $(`
        //   //       <h2>45645</h2>
        //   //       <p>56456</p>
        //   //     </article>`)

        //   // "<h2>" +554654+ "</h2>"
        //   // var Data = "<tr class='row_" + res[i].MenuId + "'>" +
        //   //     "<td><input type='checkbox' class='chkRow' " + res[i].IsActive + " id='chkid1'></td>" +
        //   //      "<td>" + res[i].MenuId + "</td>" +
        //   //         "<td>" + res[i].RoleId + "</td>" +
        //   //     "<td>" + res[i].MenuName + "</td>" +                            
        //   //     "</tr>";

        // }
      }
    });
    // $('#DetailForm').trigger("reset");
    // $('#DetailModal').html("Chi tiết đơn hàng");
    // $('#detail-modal').modal('show');
    // $('#id').val('');
  } 

//lưu vào csdl
$('#CompanyForm').submit(function(e) {
  e.preventDefault();
  var formData = new FormData(this);
  $.ajax({
    type:'POST',
    url: "{{ url('admin-crud/store-donhang')}}",
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
