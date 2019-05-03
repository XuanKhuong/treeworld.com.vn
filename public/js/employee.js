$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function(){
	$('#employees-table').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: '/getemployees',
	        columns: [
	            { data: 'id', name: 'id' },
	            { data: 'name', name: 'name' },
	            { data: 'thumbnail', name: 'thumbnail' },
	            { data: 'address', name: 'address' },
	            { data: 'email', name: 'email' },
	            { data: 'phone', name: 'phone' },
	            { data: 'action', name: 'action' },
	        ]
	    });
	// //bắt sự kiện click vào nút add

	$('.btn-add').click(function(){
		$('#modal-add').modal('show')
	})
	//bắt sự kiện submit form thêm mới
	$('#form-add').submit(function (e) {

		var data = new FormData();
		data.append('_token', $('meta[name="csrf-token"]').attr('content'));
		data.append( 'name', $('#name-add').val());
		data.append( 'thumbnail', $('#thumbnail-add')[0].files[0] );
		data.append( 'address', $('#address-add').val());
		data.append( 'email', $('#email-add').val());
		data.append( 'phone', $('#phone-add').val());
		data.append( 'user_id', $('#usid-add').val());
		data.append( 'level_user', $('#level-add').val());
		e.preventDefault();

		var url = $(this).attr('data-url');
		//alert(data);
		$.ajax({
			//sử dụng phương thức post
			type: 'post',
			url: url,
			data: data,
			processData: false,
      		contentType: false,
			success: function (response) {
				// // hiện thông báo thêm mới thành công bằng toastr
				// //ẩn modal add đi
				$('#modal-add').modal('hide');
				// location.reload();
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
			url: "/employees/"+id,
			//nếu thực hiện thành công thì chạy vào success
			success: function (response) {
				console.log(response.data.address);
				//hiển thị dữ liệu được controller trả về vào trong modal
				$('#thumbnail-show').attr('src', '/storage/' + response.data.thumbnail);
				$('#name-show').text(response.data.name);				
				$('#address-show').text(response.data.address);				
				$('#email-show').text(response.data.email);				
				$('#phone-show').text(response.data.phone);				
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
			url: 'employees/' + id + '/edit',
			success: function(response){
				$('#id_edit').val(response.data.id);
				$('.name-edit').val(response.data.name);
				$('.show-thumbnail-edit').attr('src', '/storage/' + response.data.thumbnail);
				$('.address-edit').val(response.data.address);
				$('.email-edit').val(response.data.email);
				$('.phone-edit').val(response.data.phone);
				$('.user_id-edit').val(response.data.user_id);
				$('.level_user-edit').val(response.data.level_user);
			}
		})
})

$(document).submit('#form_edit', function(e){
	//lấy data-url của form edit
	var data = new FormData();
	data.append('_token', $('meta[name="csrf-token"]').attr('content'));
	data.append( 'name', $('#name-edit').val());
	data.append( 'thumbnail', $('#thumbnail-edit')[0].files[0] );
	data.append( 'address', $('#address-edit').val());
	data.append( 'email', $('#email-edit').val());
	data.append( 'phone', $('#phone-edit').val());
	data.append( 'user_id', $('#user_id-edit').val());
	data.append( 'level_user', $('#level_user-edit').val());
	e.preventDefault();
	var id = $('#id_edit').val();
	// alert(id);
	 $.ajax({
		type: 'post',
		url: '/employees/'+id,
		data: data,
		processData: false,
      	contentType: false,
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
		url: 'employees/'+id,
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