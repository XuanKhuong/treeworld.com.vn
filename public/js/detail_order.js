$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function(){
	$('#addresses-table').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: '/getaddresses',
	        columns: [
	            { data: 'id', name: 'id' },
	            { data: 'address', name: 'address' },
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

		var url = $(this).attr('data-url');
		//alert(data);
		$.ajax({
			//sử dụng phương thức post
			type: 'post',
			url: url,
			data: {
				address: $('#address').val(),
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
			url: "/addresses/"+id,
			//nếu thực hiện thành công thì chạy vào success
			success: function (response) {
				console.log(response.data.address);
				//hiển thị dữ liệu được controller trả về vào trong modal
				$('#address-show').text(response.data.address);				
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
			url: 'addresses/' + id + '/edit',
			success: function(response){
				console.log(response.data);
				$('.address_edit').val(response.data.address);
				$('#id_edit').val(response.data.id);
			}
		})
})

$(document).submit('#form_edit', function(e){
	//lấy data-url của form edit
	// content_edit
	e.preventDefault();
	var id = $('#id_edit').val();
	// alert(id);
	 $.ajax({
		type: 'post',
		url: '/addresses/'+id,
		data: {
			address: $('#address_edit').val(),
		},
		success: function(response){
			// //ẩn modal add đi
			toastr.success('save success!')
			$('#modal-edit').modal('hide');
			location.reload();
			// setTimeout(function () {
			// 	window.location.href= "post";
			// },1500);
		}
	})
})

$(document).on('click','.btn-delete',function(e){
	e.preventDefault();

	var id = $(this).data('id');
	$.ajax({
		//phương thức delete
		type: 'delete',
		url: 'addresses/'+id,
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