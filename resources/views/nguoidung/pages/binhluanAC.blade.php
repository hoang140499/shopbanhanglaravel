@extends('index')
@section('content')
<div class="Account">
	<div class="row" >
		@include('nguoidung.pages.menuAC')
		<div class="col-sm-10 col-md-10 col-lg-10 col-xl-10" >
			<b><h2>BÌNH LUẬN CỦA TÔI</h2></b>

			<table class="table" style="table-layout: auto;">
				<thead>
					<tr>
						<th scope="col">Sản phẩm</th>
						<th scope="col">Nội dung bình luận</th>
						<th scope="col">Sửa</th>
						<th scope="col">Xóa</th>
					</tr>
				</thead>
				@foreach($comment as $value)
				<tbody>
					<tr>
						<th scope="row">
							<a href="{{ asset('sanpham/') }}/{{ $value->id_HH }}">
								<img src="{{ asset('public/upload/AnhSanPham/') }}/{{ $value->HangHoa->Hinh }}" alt="" width="100px" height="100px" style="border-radius: 5%">
							</a>
						</th>
						<td>{{ $value->NoiDung }}</td>
						<td>
							<!-- Button trigger modal -->
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="outline: none; border: none; color: none; background-color: initial; color: black; box-shadow:none; ">
							  	<i class="fas fa-tools"></i>
							</button>
						</td>
						<td><i class="fas fa-trash-alt"></i></td>
					</tr>
				</tbody>
				@endforeach
			</table>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 100%;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sửa nội dung bình luận</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form method="post" id="addform">
       	{{-- {{ csrf_field() }} --}}
	      <div class="modal-body">      			
				<div class="form-group">
				    <textarea class="form-control" rows="5" name="NoiDung" id="NoiDung" required></textarea>
				</div>		
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save changes</button>
	      </div>
      </form>
    </div>
  </div>
</div>

{{-- <div id="change-comment" class="change-comment" >
	<div class="comment-content" >
		<h2>Nhập nội dung bình luận</h2>
		<form action="" method="post" style="text-align: left;" id="updateComment">
			{{ csrf_field() }}
			<div class="form-group">
			    <textarea class="form-control" rows="5" id="comment" name="NoiDung" required></textarea>
			    <button class="btn btn-primary" type="submit" name="comment" style="margin:10px 0px 0px 20px;">Bình luận</button>
			</div>
		</form>
		<span class="closeBtn-Comment">&times;</span>
	</div>
</div> --}}
<script type="text/javascript">
	var modal = document.getElementById('change-comment');	
	var modalBtn = document.getElementById('change-commentBtn');
	var closeBtn = document.getElementsByClassName('closeBtn-Comment')[0];
	
	modalBtn.addEventListener('click', openModal);
	closeBtn.addEventListener('click', closeModal);
	window.addEventListener('click', outsideClick);
	
	function openModal(){
		modal.style.display = 'flex';
	}
	function closeModal(){
		modal.style.display = 'none';
	}
	function outsideClick(e){
		if(e.target == modal){
			modal.style.display = 'none';
		}
	}

	// function changeComment(){
	// 	var NoiDung = $('#NoiDung').val();
	// 	$.ajax({
	// 		url: "/account/comment",
	// 		method: "POST",
	// 		data: {NoiDung:NoiDung},
	// 		success:function(data){
	// 			alert('Thanh cong');
	// 		}
	// 	});
	// }

	$(document).ready(function(){
		$('#addform').on('submit', function(e){
			e.prevenDefault();
			$.ajax({
				type: "POST",
				url: "/account/comment",
				data: $('#addform').serialize(),
				success: function(response){
					console.log(response)
					$('#exampleModal').modal('hide')
					alert("save");
				},
				error: function(error){
					console.log(error)
					alert("not save");
				}
			});
		});
	});
</script>
@endsection