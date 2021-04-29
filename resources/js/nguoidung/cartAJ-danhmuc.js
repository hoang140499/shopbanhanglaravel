	function addAlert(){
		alertify.success("Thêm thành công");
	}
	function add(id){
		
		$.ajax({
			url: '../AddCartAJ/'+id,
			type: 'get',
		}).done(function(data){
			//console.log(data);
			RenderCart(data);
			alertify.success("Thêm thành công");
		});
	}
	function del(id){
	// $('#change-item-cart').on("click",".delete-item i", function(id){
		console.log(id);
		$.ajax({
			url: '../Delete-Item-CartAJ/'+id,
			type: 'get',
		}).done(function(data){
			//console.log(data);
			RenderCart(data);
			alertify.success("Xóa thành công");
		});
	}

	function RenderCart(data){
		$('#change-item-cart').empty();
		$('#change-item-cart').html(data);
		if ($('#total-quanty-cart').val() > 0) {
			$('#total-quanty-show').text("("+$('#total-quanty-cart').val()+")");
		}else{
			$('#total-quanty-show').text("(0)");
		}
		//console.log($('#total-quanty-cart').val());
	}