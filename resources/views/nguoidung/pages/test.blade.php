@extends('index')
@section('content')
<div class="container">
	<div class="row col-lg-5">
		<h2>Request</h2>
		<form>
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="id" class="form-control" placeholder="Name" required="">
            </div>		
			<button type="button" class="btn btn-warning" id="getRequest">getRequest</button>
		</form>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript">
$(document).ready( function () {
	 $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
		$('#getRequest').click(function(e){
			//alert(555);
			e.preventDefault();
        	var id = $("input[name=id]").val();
        	//alert(NoiDung);
		 	$.ajax({
		        type:"POST",
			    url: "{{ url('/ajax') }}",
			    dataType: 'json',
			    data:{id:id}, //dùng để trả qua Request bên controller nếu kh có thì bên controller sẽ kh thể nhận dc $request->all();
			    success: function(data){
		          console.log(data);
	        },
       	});
	});
});
</script>		
@endsection