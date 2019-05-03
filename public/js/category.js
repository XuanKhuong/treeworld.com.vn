$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function(){
	$('#categories-table').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: '/getcategories',
	        columns: [
	            { data: 'id', name: 'id' },
	            { data: 'name', name: 'name' },
	            { data: 'thumbnail', name: 'thumbnail' },
	            { data: 'description', name: 'description' },
	            { data: 'action', name: 'action' },
	        ]
	    });
	// //bắt sự kiện click vào nút add

	$('.btn-add').click(function(){
		$('#modal-add').modal('show')
		function slug(str){
			var $slug = '';
			var trimmed = $.trim(str);
			$slug = trimmed.replace(/[^a-z0-9-]/gi, '-').replace(/-+/g, '-').replace(/^-|-$/g, '');
			return $slug.toLowerCase();
		}
		$('#name').keyup(function(){
			var data = $('#name').val()
			$('#slug').val(slug(data));
		});
	})
	//bắt sự kiện submit form thêm mới
	$('#form-add').submit(function (e) {
		var data = new FormData();
		data.append('_token', $('meta[name="csrf-token"]').attr('content'));
		data.append( 'name', $('#name').val());
		data.append( 'thumbnail', $('#thumbnail')[0].files[0] );
		data.append( 'description', $('#description').val());
		data.append( 'slug', $('#slug').val());
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
				setTimeout(function () {
					window.location.href= "categories"; 
				},1500);
				toastr.success('Add new product success!');
			},
			error: function (jqXHR, textStatus, errorThrown) {
				//xử lý lỗi tại đây
			}
		})
	});

	$('body').delegate('.btn-detail','click',  function (e) {
		e.preventDefault();
		$('#modal_show').modal('show');
		//lấy dữ liệu từ attribute data-url lưu vào biến url
		// var url=$(this).attr('href');
		var id = $(this).attr('data-id');
		
		$.ajax({
			//sử dụng phương thức get
			type: 'get',
			url: "/categories/"+id,
			//nếu thực hiện thành công thì chạy vào success
			success: function (response) {
				// console.log(response.data.address);
				//hiển thị dữ liệu được controller trả về vào trong modal
				$('#thumbnail-show').attr('src', '/storage/' + response.data.thumbnail);
				$('#name-show').text(response.data.name);			
				$('#description-show').text(response.data.description);			
			},
			error: function (jqXHR, textStatus, errorThrown) {
				//xử lý lỗi tại đây
			}
		})
	})



	$('body').delegate('.btn-edit','click',  function (e) {
		e.preventDefault();
			$('#modal-edit').modal('show');
			var id = $(this).data('id');
			function slug(str){
				var $slug = '';
				var trimmed = $.trim(str);
				$slug = trimmed.replace(/[^a-z0-9-]/gi, '-').replace(/-+/g, '-').replace(/^-|-$/g, '');
				return $slug.toLowerCase();
			}
			$('#name_edit').keyup(function(){
				var data = $('#name_edit').val()
				$('#slug_edit').val(slug(data));
			});
			$.ajax({
			type: 'get',
			url: 'categories/' + id + '/edit',
			success: function(response){
				console.log(response.data);
				$('.name_edit').val(response.data.name);
				$('.parent_id_edit').val(response.data.parent_id);
				$('.show-thumbnail-edit').attr('src', '/storage/' + response.data.thumbnail);
				$('.slug_edit').val(response.data.slug);
				$('.description_edit').val(response.data.description);
				$('#id_edit').val(response.data.id);
			}
		})
	})

	$('body').delegate('#form_edit','submit', function(e){
		//lấy data-url của form edit
		// content_edit
		var data = new FormData();
		data.append('_token', $('meta[name="csrf-token"]').attr('content'));
		data.append( 'name', $('#name_edit').val());
		data.append( 'thumbnail', $('#thumbnail_edit')[0].files[0] );
		data.append( 'description', $('#description_edit').val());
		data.append( 'slug', $('#slug_edit').val());
		e.preventDefault();
		var id = $('#id_edit').val();
		// alert(id);
		 $.ajax({
			type: 'post',
			url: '/categories/'+id,
			data: data,
			processData: false,
	      	contentType: false,
			success: function(response){
				// //ẩn modal add đi
				toastr.success('save success!')
				$('#modal-edit').modal('hide');
				setTimeout(function () {
					window.location.href= "categories";
				},1500);
			}
		})
	})

	$('body').delegate('.btn-delete', 'click', function(e){
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

})



