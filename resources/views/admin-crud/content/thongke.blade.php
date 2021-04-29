@extends('admin-crud.index')
@section('content')
<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Thống kê năm 2021</h1>
          <div class="pull-right mb-2">
            <a class="btn btn-outline-primary" onClick="chart()" href="{{ URL::to('admin-crud/thongke') }}" style="display: none">Dạng biểu đồ</a>
            <a class="btn btn-outline-danger" onClick="table()" href="javascript:void(0)">Dạng bảng</a>
          </div>

          @if ($message = Session::get('success'))
          <div class="alert alert-success">
            <p>{{ $message }}</p>
          </div>
          @endif
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body" style="display: none">
              <div class="table-responsive">
                <table class="table table-bordered" id="ajax-crud-datatable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tháng</th>
                      <th>Năm</th>
                      <th>Tổng số lượng</th>
                      <th>Tổng tiền</th>
                      <th>Tổng số đơn</th>
                      <th>Thao tác</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div id="chart" name="chart">
          <div  style="width: 80%;margin: 0 auto; ">
              {!! $chart->container() !!}
          </div>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
          {!! $chart->script() !!}
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
            {{-- <input type="hidden" name="thang" id="thang">  --}}
            <div class="form-group">
                  <div class="col-sm-12">
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="table_id" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th>ID_HD</th>
                              <th>ID_HH</th>
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
                Tổng số lượng
                <h2  id="TongSoLuong" name="TongSoLuong" ></h2>
            </div>
            <div class="col-sm-offset-2 col-sm-10">
                Tổng tiền
                 <h2  id="TongTien" name="TongTien" ></h2>
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
      ajax: "{{ url('admin-crud/thongke') }}",
      columns: [
      { data: 'thang', name: 'thang' },
      { data: 'nam', name: 'nam' },
      { data: 'sum_sl', name: 'sum_sl' },
      { data: 'sum_gia', name: 'sum_gia', render: $.fn.dataTable.render.number(',', '.', '') },
      { data: 'count_sodon', name: 'count_sodon' },
      // { data: 'id_DM', name: 'id_DM' },
      //{ data: 'danhmuc.TenDanhMuc', name: 'danhmuc.TenDanhMuc' },
      // { data: 'created_at', name: 'created_at' },
      {data: 'action', name: 'action', orderable: false},
      ],
      order: [[0, 'asc']] // sắp xếp cột id tăng dân
    });
  });

  //mở modal add lên
  function table(){
    $("#chart").hide(300); 
    $(".card-body").show(300); 
    $(".btn-outline-danger").hide(); 
    $(".btn-outline-primary").show(); 
  }  
  function chart(){
  //   var x = document.getElementById("chart");

  //     if (x.style.display 
  // === "none") {
  //     x.style.display = "block";
  //   } else {
  //     x.style.display = 
  //   "none";
  //   }
    //$("#chart").show(300); 
    //$(".chart").show(300); 
    //$(".card-body").hide(300); 
    //$(".btn-outline-danger").show(); 
    //$(".btn-outline-primary").hide(); 
  }  

  function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
  }
  function detailFunc(thang){
    $.ajax({
      type:"POST",
      url: "{{ url('admin-crud/detail-thongke') }}",
      data: { thang: thang },
      dataType: 'json',
      success: function(res){
        $('#CompanyModal').html("Chi tiết");
        $('#company-modal').modal('show');
        var columns;
        var TongSoLuong=0;
        var TongTien=0;
        $.each(res, function (i, item) {             
          columns +=    "<tr><td>" + item.id_DH + "</td><td>" + item.id_HH + "</td><td><img src={{ URL::to('public/upload/AnhSanPham/') }}/"+item.Hinh+" style=width:100px></td><td>" + item.TenHH + "</td><td>" + item.SoLuong + "</td><td>" + formatNumber(item.GiaDatHang) + "</td></tr>";
          TongSoLuong += item.SoLuong;
          TongTien += item.GiaDatHang;
        });
        $('#table_id tbody').empty();
        $('#table_id tbody').append(columns);
        console.log(TongSoLuong);
        $('#TongSoLuong').html(TongSoLuong);
        $('#TongTien').html(formatNumber(TongTien)+'VNĐ');
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