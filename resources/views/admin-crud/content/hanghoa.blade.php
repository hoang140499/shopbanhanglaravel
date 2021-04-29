@extends('admin-crud.index')
@section('content')
<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Hàng hóa</h1>
          <div class="pull-right mb-2">
            <a class="btn btn-primary" onClick="add()" href="javascript:void(0)">Thêm hàng hóa</a>
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
                      <th>Tên</th>
                      <th>Giá</th>
                      <th>SL</th>
                      <th>Nhóm</th>
                      <th>Hình</th>
                      <th>Hình minh họa</th>
                      <th>Màu</th>
                      <th>Size</th>
                      <th>Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($hanghoa as $value)
    <tr>
      <td>{{ $value->id }}</td>
      <td>{{ $value->TenHH }}</td>
      <td>{{ $value->Gia }}</td>
      <td>{{ $value->SoLuongHang }}</td>
      <td><img src="{{ URL::to('public/upload/AnhSanpham/') }}/{{ $value->Hinh }}" width="60" height="60" /></td>     
      {{-- hiển thị ảnh minh họa --}}
      <td>
        <?php
        $a = $value->HinhMinhHoa;
        $a = explode(" ",$a);
        $count = count($a)-1;
        for ($i=0; $i<$count; $i++ ){ 
          if($count>0){
            ?>
            <img src="{{ URL::to('public/upload/AnhMinhhoa/') }}/{{ $a[$i] }}"width="60" height="60" />
            <?php 
          }
        }
        ?>
      </td>
      <td>{{ $value->Mau }}</td>
      <td>{{ $value->Size }}</td>
      {{-- đóng hiển thị ảnh minh họa --}}
{{--       <td><a href="javascript:void(0)" data-toggle="tooltip" onClick="editFunc({{ $value->id }})" data-original-title="Edit" class="edit btn btn-success edit">
      Edit
      </a>
      <a href="javascript:void(0);" id="delete-compnay" onClick="deleteFunc({{ $value->id }})" data-toggle="tooltip" data-original-title="Delete" class="delete btn btn-danger">
      Delete
      </a></td> --}}

    </tr>
    @endforeach
                  </tbody>
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
            {{-- <input type="hidden" name="id" id="id">  --}}
            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">ID</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" id="id" name="id" placeholder="Mã hàng" maxlength="50" required="">
              </div>
            </div>
            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">Tên</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" id="TenHH" name="TenHH" placeholder="Tên hàng hóa" maxlength="50" required="">
              </div>
            </div>
            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">Giá</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" id="Gia" name="Gia" placeholder="Giá" maxlength="50" required="">
              </div>
            </div>
            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">Số lượng</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" id="SoLuongHang" name="SoLuongHang" placeholder="Số lượng hàng" maxlength="50" required="">
              </div>
            </div>
            <div class="form-group">
              <label for="name" class="col-sm-4 control-label">Thuộc nhóm</label>
              <div class="col-sm-12">
                <select class="form-control" id="id_NHH" name="id_NHH">
                  @foreach($nhomhanghoa as $value)
                  <option value="{{ $value->id }}">{{ $value->TenNhom }}</option> 
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">Hình</label>
              <div class="col-sm-12">
                <input type="file" name="Hinh">
              </div>
            </div>
            <div class="form-group">
              <label for="name" class="col-sm-3 control-label">Hình minh họa</label>
              <div class="col-sm-12">
                <input type="file" name="HinhMinhHoa[]" multiple>
              </div>
            </div>
            <div class="form-group">
              <label for="name" class="col-sm-4 control-label">Màu</label>
              <div class="col-sm-12">
                <select class="form-control" id="id_gtri_thuoc_tinh_1" name="id_gtri_thuoc_tinh_1">
                  @foreach($gia_tri_thuoc_tinh_1 as $value)
                  <option value="{{ $value->id }}">{{ $value->gia_tri }}</option> 
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="name" class="col-sm-4 control-label">Size</label>
              <div class="col-sm-12">
                <select class="form-control" id="id_gtri_thuoc_tinh_2" name="id_gtri_thuoc_tinh_2">
                  @foreach($gia_tri_thuoc_tinh_2 as $value)
                    <option value="{{ $value->id }}">{{ $value->gia_tri }}</option> 
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="name" class="col-sm-3 control-label">Mô tả</label>
              <div class="col-sm-12">
                {{-- <textarea id="MoTaHH" name="MoTaHH" cols="85" rows="20"></textarea> --}}
               {{--  <textarea class="form-control form-control-user" id="ckeditor" name="MoTaHH"aria-describedby="emailHelp" placeholder="Enter Email Address..."> --}}
                <textarea class="form-control form-control-user" id="ckeditor" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="noidung">
                </textarea>
                {{-- <input type="text" style="width: 100%; height: 100%"> --}}
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
<script src="//cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
        <!-- /.container-fluid -->
<script type="text/javascript">
    
   
</script>
<script type="text/javascript">
  var editor = CKEDITOR.replace('ckeditor', {

  // extraPlugins : 'filebrowser',
  // filebrowserBrowseUrl : 'brower.php',
  // filebrowserUploadMethod : 'form',
  // filebrowserUploadUrl : 'upload.php',
  });

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
      ajax: "{{ url('admin-crud/hanghoa') }}",
      columns: [
      { data: 'id', name: 'id' },
      { data: 'TenHH', name: 'TenHH' },
      { data: 'Gia', name: 'Gia' },
      { data: 'SoLuongHang', name: 'SoLuongHang' },
      { data: 'nhomhanghoa.TenNhom', name: 'nhomhanghoa.TenNhom' },
      { data: 'Hinh', name: 'Hinh', "render": function(data, type, row) {
        return '<img src="{{ URL::to('public/upload/AnhSanpham/') }}/'+data+'" style="width:70px"/>';
       } 
      },
      { data: 'HinhMinhHoa', name: 'HinhMinhHoa', "render": function(data, type, row) {
        var data;
        var string = data.split(" ");
        for (i = 0; i < string.length; i++) {
          return ['<img src="{{ URL::to('public/upload/AnhMinhHoa/') }}/'+string[0]+'" style="width:70px"/>', '<img src="{{ URL::to('public/upload/AnhMinhHoa/') }}/'+string[1]+'" style="width:70px"/>','<img src="{{ URL::to('public/upload/AnhMinhHoa/') }}/'+string[2]+'" style="width:70px"/>','<img src="{{ URL::to('public/upload/AnhMinhHoa/') }}/'+string[3]+'" style="width:70px"/>']; 

          // return '<img src="{{ URL::to('public/upload/AnhMinhHoa/') }}/'+string[i]+'" style="width:70px"/>';      
        }
       } 
      },
      { data: 'gia_tri_thuoc_tinh_1.gia_tri', name: 'gia_tri_thuoc_tinh_1.gia_tri' , "render" : function(data, type, row){
          var data;
          if (data){
            return data;
          }else{
            return null;
          }
        }
      },


      { data: 'gia_tri_thuoc_tinh_2.gia_tri', name: 'gia_tri_thuoc_tinh_2.gia_tri' , "render" : function(data, type, row){
          var data;
          if (data){
            return data;
          }else{
            return null;
          }
        }
      },
      // { data: 'Mau', name: 'Mau' },
      // { data: 'Size', name: 'Size' },
      
      // { data: 'created_at', name: 'created_at' },
      {data: 'action', name: 'action', orderable: false},
      ],
      order: [[0, 'asc']] // sắp xếp cột id tăng dân
    });
  });

  //mở modal add lên
  function add(){

    $('#CompanyForm').trigger("reset");
    $('#CompanyModal').html("Thêm hàng hóa");
    $('#company-modal').modal('show');
    $('#id').val('');
  }   

  function editFunc(id){
    $.ajax({
      type:"POST",
      url: "{{ url('admin-crud/edit-hanghoa') }}",
      data: { id: id },
      dataType: 'json',
      success: function(res){
        $('#CompanyModal').html("Sửa hàng hóa");
        $('#company-modal').modal('show');
        $('#id').val(res.id);
        //$("#id").prop('disabled', true);
        $('#TenHH').val(res.TenHH);
        $('#Gia').val(res.Gia);
        $('#SoLuongHang').val(res.SoLuongHang);
        $('#id_NHH').val(res.id_NHH);
        $('#id_gtri_thuoc_tinh_1').val(res.id_gtri_thuoc_tinh_1);
        $('#id_gtri_thuoc_tinh_2').val(res.id_gtri_thuoc_tinh_2);
        //$('#MoTaHH').val(res.MoTaHH);
        CKEDITOR.instances['ckeditor'].setData(res.MoTaHH);
        //$('#ckeditor').val(res.Gia);
        //document.getElementById("MoTaHH").value = "Fifth Avenue, New York City";
      }
    });
  }  
  function deleteFunc(id){
    if (confirm("Bạn có chắc không?") == true) {
      var id = id;
// ajax
    $.ajax({
      type:"POST",
      url: "{{ url('admin-crud/delete-hanghoa') }}",
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
  for ( instance in CKEDITOR.instances ) {
    CKEDITOR.instances[instance].updateElement();
  }
  e.preventDefault();
  var formData = new FormData(this);
  $.ajax({
    type:'POST',
    url: "{{ url('admin-crud/store-hanghoa')}}",
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
      console.log(data);
    },
    error: function(data){
      console.log(data);
    }
  });
});
</script>
@endsection