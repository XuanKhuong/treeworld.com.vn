$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function(){
	$('#accessories-table').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: '/getaccessories',
	        columns: [
	            { data: 'id', name: 'id' },
	            { data: 'name', name: 'name' },
	            { data: 'thumbnail', name: 'thumbnail' },
	            { data: 'description', name: 'description' },
	            { data: 'price', name: 'price' },
	            { data: 'action', name: 'action' },
	        ]
	    });

	$('.btn-add').click(function(){
		$('#modal-add').modal('show')
	})
	//bắt sự kiện submit form thêm mới
	$('#form-add').submit(function (e) {
		var data = new FormData();
		data.append('_token', $('meta[name="csrf-token"]').attr('content'));
		data.append( 'name', $('#name').val());
		data.append( 'thumbnail', $('#thumbnail')[0].files[0] );
		data.append( 'description', $('#description').val());
		data.append( 'price', $('#price').val());
		data.append( 'category_id', $('#category_id').val());

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
				toastr.success('Add new product success!')
				setTimeout(function () {
				window.location.href= "accessories";
			},1500);
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
			url: "/accessories/"+id,
			//nếu thực hiện thành công thì chạy vào success
			success: function (response) {
				// console.log(response.data.title);
				//hiển thị dữ liệu được controller trả về vào trong modal
				$('#name-show').text(response.data.name);
				$('#thumbnail-show').attr('src', '/storage/' + response.data.thumbnail);
				$('#description-show').text(response.data.description);
				$('#price-show').text(response.data.price);
				
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
			url: 'accessories/' + id + '/edit',
			success: function(response){
				console.log(response.data);
				$('.name_edit').val(response.data.name);
				$('#id_edit').val(response.data.id);
				$('.description_edit').val(response.data.description);
				$('.img-edit').append('<img src="/storage/'+response.data.thumbnail+'" style="width: 100px; height: 100px; border-radius: 12px;">')
				$('.category_id_edit').val(response.data.category_id);
				$('.price_edit').val(response.data.price);
			}
		})
})

$(document).submit('#form_edit', function(e){
	//lấy data-url của form edit

	// alert(tinyMCE.getContent('#content_edit'));
	var data = new FormData();
	data.append('_token', $('meta[name="csrf-token"]').attr('content'));
	data.append( 'name', $('#name_edit').val());
	data.append( 'thumbnail', $('#thumbnail_edit')[0].files[0] );
	data.append( 'description', $('#description_edit').val());
	data.append( 'price', $('#price_edit').val());
	data.append( 'category_id', $('#category_id_edit').val());
	e.preventDefault();
	var id = $('#id_edit').val();
	// alert(id);
	 $.ajax({
		type: 'post',
		url: '/accessories/'+id,
		data: data,
		processData: false,
  		contentType: false,
		success: function(response){
			// //ẩn modal add đi
			toastr.success('save success!')
			$('#modal-edit').modal('hide');
			setTimeout(function () {
				window.location.href= "accessories";
			},1500);
		}
	})
})

$(document).on('click','.btn-delete',function(e){
	e.preventDefault();

	var id = $(this).data('id');
	$.ajax({
		//phương thức delete
		type: 'delete',
		url: 'accessories/'+id,
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