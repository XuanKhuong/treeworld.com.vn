$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function(){
	$('#colors-table').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: '/getcolors',
	        columns: [
	            { data: 'id', name: 'id' },
	            { data: 'name', name: 'name' },
	            { data: 'action', name: 'action' },
	        ]
	    });
	// //bắt sự kiện click vào nút add

	$('.btn-add').click(function(){
		$('#modal-add').modal('show')
	})
	//bắt sự kiện submit form thêm mới
	$('#form-add').submit(function (e) {
		e.preventDefault();
		var nameColor;
		var codeColor;
		var url = $(this).attr('data-url');
		if(document.getElementById('redColor').checked){
			nameColor = "Đỏ";
			codeColor = "#CC0000";
		}
		if(document.getElementById('blueColor').checked){
			nameColor = "Xanh Dương";
			codeColor = "#000066";
		}
		if(document.getElementById('blackColor').checked){
			nameColor = "Đen";
			codeColor = "#000011";
		}
		if(document.getElementById('greenColor').checked){
			nameColor = "Xanh Lá";
			codeColor = "#00BB00";
		}
		if(document.getElementById('yellowColor').checked){
			nameColor = "Vàng";
			codeColor = "#FFFF00";
		}
		//alert(data);
		$.ajax({
			//sử dụng phương thức post
			type: 'post',
			url: url,
			data: {
				name: nameColor,
				code_color: codeColor,
			},
			success: function (response) {
				
				// // hiện thông báo thêm mới thành công bằng toastr
				// //ẩn modal add đi
				$('#modal-add').modal('hide');
				location.reload();
				toastr.success('Add new product success!')
				// window.location.reload()
			},
			error: function (jqXHR, textStatus, errorThrown) {
				//xử lý lỗi tại đây
			}
		})
	});

})



$(document).on('click', '.btn-detail', function (e) {
	e.preventDefault();
	$('#modal_show').modal('show');
		//lấy dữ liệu từ attribute data-url lưu vào biến url
		// var url=$(this).attr('href');
		var id = $(this).attr('data-id');
		
		$.ajax({
			//sử dụng phương thức get
			type: 'get',
			url: "/colors/"+id,
			//nếu thực hiện thành công thì chạy vào success
			success: function (response) {
				//hiển thị dữ liệu được controller trả về vào trong modal
				$('#name-show').text(response.data.name);
				document.getElementById("showColor").style.background= response.data.code_color;
				// $('#showColor').css('background',response.data.code_color);		
			},
			error: function (jqXHR, textStatus, errorThrown) {
				//xử lý lỗi tại đây
			}
		})
})



$(document).on('click', '.btn-edit', function (e) {
	e.preventDefault();
			$('#modal-edit').modal('show');
			var id = $(this).data('id');
			$.ajax({
			type: 'get',
			url: 'colors/' + id + '/edit',
			success: function(response){
				$('#id_edit').val(response.data.id);
			}
		})
})

$(document).submit('#form_edit', function(e){
	//lấy data-url của form edit
	// content_edit
	var nameColor;
	var codeColor;
	var url = $(this).attr('data-url');
	if(document.getElementById('redColor_edit').checked){
		nameColor = "Đỏ";
		codeColor = "#CC0000";
	}
	if(document.getElementById('blueColor_edit').checked){
		nameColor = "Xanh Dương";
		codeColor = "#000066";
	}
	if(document.getElementById('blackColor_edit').checked){
		nameColor = "Đen";
		codeColor = "#000011";
	}
	if(document.getElementById('greenColor_edit').checked){
		nameColor = "Xanh Lá";
		codeColor = "#00BB00";
	}
	if(document.getElementById('yellowColor_edit').checked){
		nameColor = "Vàng";
		codeColor = "#FFFF00";
	}
	e.preventDefault();
	var id = $('#id_edit').val();
	// alert(id);
	 $.ajax({
		type: 'post',
		url: '/colors/'+id,
		data: {
			name: nameColor,
			code_color: codeColor,
		},
		success: function(response){
			//ẩn modal add đi
			// alert(response.data.name);
			$('#modal-edit').modal('hide');
			window.location.reload();
			toastr.success('save success!')
		}
	})
})

$(document).on('click','.btn-delete',function(e){
	e.preventDefault();

	var id = $(this).data('id');
	$.ajax({
		//phương thức delete
		type: 'delete',
		url: 'colors/'+id,
		data:{
			_token: $('meta[name="csrf-token"]').attr('content'),
		},
		success: function (response) {
			//thông báo xoá thành công bằng toastr
			location.reload();
			toastr.warning('delete todo success!')
		},
		error: function (error) {
			
		}
	})
})