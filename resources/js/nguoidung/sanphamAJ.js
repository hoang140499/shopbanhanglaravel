//test + formatNumber + Render dc gọi khi nhấn vào chọn màu sẽ tải csdl size thuộc màu đó lên
//đồng thời mặc định size ban đầu sẽ là giá trị đầu tiên dc tìm thấy
//hiển thị lun cả cmt của size thuộc màu đầu tiên
//khi chọn sẽ dc tô màu (nhấn 2 lần) 
function test(id){
		$.ajax({
			url: '../sanphamAJ/'+id,
			type: 'get',
			dataType: 'json',
	        contentType: false,
	        processData: false,
			success : function(data){
				//console.log(data[1]);
				// $('#tenhh').html(data.TenHH);
				// $('#gia').html(data.Gia);
				// $('#mota').html(data.MoTaHH);
				Render(data);
				}
			});
	}
function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
  }
function Render(data){
		// $('#tenhh').empty();
		// $('#gia').empty();
		// $('#mota').empty();
		$('#ten').html(data[0].TenHH);
		$('#tenhh').html(data[0].TenHH);
		// $('#tenhh').html("<div>fghfgh</div>");
		$('#gia').html(formatNumber(data[0].Gia)+'đ');
		$('#mota').html(data[0].MoTaHH);
		//hình
		$('#hinh').empty();
		var src = "../public/upload/AnhSanPham/"+data[0].Hinh;
		$('#hinh').html($('<img>',{id:'theImg',src: src, width: "100%"}))

  		//hinhminhhoa
		$('#hinhminhhoa').empty();
		var str = data[0].HinhMinhHoa;
		var a = str.split(" ");
		for(var i = 0; i < a.length-1; i++){
			var src_hmh = "../public/upload/AnhMinhHoa/"+a[i];
			$('#hinhminhhoa').append('<a href="'+src_hmh+'" data-lightbox="mygallery"><img id="my_image" src="'+src_hmh+'"width="51%" style="margin-top:10px;" /></a>');
		}

		//link
		var src_link = "../AddCart/"+data[0].id;
		$(".muangay-l a").attr("href", src_link);

		//màu
		$('.mausac button').click(function(){
		  	$(".mausac button").css("background-color", "white");
		  	$(this).css('background-color', '#17a2b8');

		  	// for(var j = 0; j < data[1].length; j++){
			  // 	console.log(data[1][j].id);
			  // }
		});

		//size
	  	$('#size').empty();
	  	//console.log(data[1]);	  	
	  	for(var j = 0; j < data[1].length; j++){
			//console.log(data[1][j].id);
			$('#size').append('<button class="ml-1" onclick="loadSize('+data[1][j].id+')">'+data[1][j].gia_tri_thuoc_tinh_2.gia_tri+'</button>');
			if (j==0) {
				$('#size button').css('background-color', '#17a2b8');
			}
		}
		//binhluan
		$('.binhluan').empty();
		var src_action = "../Comment/"+data[0].id;
		for(var j = 0; j < data[2].length; j++){
			//console.log(data[2][j].NoiDung);
			$('#binhluan').append(
				'<table width="100%" style="text-align:left; margin-top:10px" ><tr><td rowspan="2" width="10%" style=""><img src="../public/upload/AnhDaiDien/user1.jpg" alt="" style="width: 100px; height: 100px;border-radius: 50%;"></td><td width="80%"><b>'
				+data[2][j].khachhang.HoTenKH+
				'</b></td></tr><tr><td style="">'
				+data[2][j].NoiDung+
				'</td></tr></table>');
		}
		$(".form #id_HH").attr("value", data[0].id);
		$(".form #getRequest").attr("onClick", 'binhluan('+data[0].id+')');

		//like
		if (data[4] == null) {
			$(".countlike button").html('<i class="far fa-thumbs-up"></i> Thích ('+data[3].count+')');
			$(".countlike button").attr("onClick", 'liked('+data[0].id+')');
			$(".countlike button").attr("id", 'LikeRequest');
		}else{
			$(".countlike button").html('<i class="far fa-thumbs-up"></i> Đã thích ('+data[3].count+')');
			$(".countlike button").attr("onClick", 'Unliked('+data[0].id+')');
			$(".countlike button").attr("id", 'UnLikeRequest');
		}
		//console.log(data[4]);
	}


//loadSize + Load dùng để chọn size và hiển thị thông tin lên trang bao gồm
//hình,tên,binhluan
function loadSize(id){		
		$.ajax({
			url: '../sanphamAJ_Comment/'+id,
			type: 'get',
			dataType: 'json',
	        contentType: false,
	        processData: false,
			success : function(data){
				Load(data);
				}
			});
	}
//hàm load này load all comment sai
function Load(data){
	//console.log(data[0]);
	console.log(data[2]);
	$('#size button').click(function(){
	  	$("#size button").css("background-color", "#17175a");
	  	$(this).css('background-color', '#17a2b8');
	});
	
	//link
	var src_link = "../AddCart/"+data[0].id;
	$(".muangay-l a").attr("href", src_link);

	//binhluan
	$('.binhluan').empty();
	var src_action = "../Comment/"+data[0].id;
	for(var j = 0; j < data[2].length; j++){
		//console.log(data[2][j].NoiDung);
		$('#binhluan').append(
			'<table width="100%" style="text-align:left; margin-top:10px" ><tr><td rowspan="2" width="10%" style=""><img src="../public/upload/AnhDaiDien/user1.jpg" alt="" style="width: 100px; height: 100px;border-radius: 50%;"></td><td width="80%"><b>'
			+data[2][j].khachhang.HoTenKH+
			'</b></td></tr><tr><td style="">'
			+data[2][j].NoiDung+
			'</td></tr></table>');
	}
	$(".form #id_HH").attr("value", data[0].id);
	$(".form #getRequest").attr("onClick", 'binhluan('+data[0].id+')');

	//like
	if (data[4] == null) {
		$(".countlike button").html('<i class="far fa-thumbs-up"></i> Thích ('+data[3].count+')');
		$(".countlike button").attr("onClick", 'liked('+data[0].id+')');
		$(".countlike button").attr("id", 'LikeRequest');
	}else{
		$(".countlike button").html('<i class="far fa-thumbs-up"></i> Đã thích ('+data[3].count+')');
		$(".countlike button").attr("onClick", 'Unliked('+data[0].id+')');
		$(".countlike button").attr("id", 'UnLikeRequest');
	}
}

//binhluan(id) dc gọi khi ng dùng nhấn vào bình luận để tải tất cả các bình luận thuộc id đó 
//đồng thời tải luôn bình luận vừa dc thêm mà k reset trang
function binhluan(id){
	$.ajax({
		url: '../sanphamAJ_Comment/'+id,
		type: 'get',
		dataType: 'json',
        contentType: false,
        processData: false,
		success : function(data){
			$('.binhluan').empty();
			for(var j = 0; j < data[2].length; j++){
					//console.log(data[2][j].NoiDung);
				$('#binhluan').append(
					'<table width="100%" style="text-align:left; margin-top:10px" ><tr><td rowspan="2" width="10%" style=""><img src="../public/upload/AnhDaiDien/user1.jpg" alt="" style="width: 100px; height: 100px;border-radius: 50%;"></td><td width="80%"><b>'
					+data[2][j].khachhang.HoTenKH+
					'</b></td></tr><tr><td style="">'
					+data[2][j].NoiDung+
					'</td></tr></table>');
			}
		}
	});
}

function liked(id){
	//$('#countlike').empty();
	$.ajax({
		url: '../sanphamAJ/'+id,
		type: 'get',
		dataType: 'json',
        contentType: false,
        processData: false,
		success : function(data){
			//console.log(data[3]);
			$(".countlike button").html('<i class="far fa-thumbs-up"></i> Đã thích ('+data[3].count+')');
			$(".countlike button").attr("onClick", 'Unliked('+id+')');
			$(".countlike button").attr("id", 'UnLikeRequest');
		}
	});
}

function Unliked(id){
	//$('#countlike').empty();
	$.ajax({
		url: '../sanphamAJ/'+id,
		type: 'get',
		dataType: 'json',
        contentType: false,
        processData: false,
		success : function(data){
			//console.log(data[3]);
			$(".countlike button").html('<i class="far fa-thumbs-up"></i> Thích ('+data[3].count+')');
			$(".countlike button").attr("onClick", 'liked('+id+')');
			$(".countlike button").attr("id", 'LikeRequest');
		}
	});
}

