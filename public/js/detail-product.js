$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function(){
	$('#detail-products-table').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: '/getdetailproducts',
	        columns: [
	            { data: 'id', name: 'id' },
	            { data: 'name', name: 'name' },
	            { data: 'quantity', name: 'quantity' },
	            { data: 'price', name: 'price' },
	            { data: 'life_expectancy', name: 'life_expectancy' },
	            { data: 'sale_price', name: 'sale_price' },
	            { data: 'action', name: 'action' },
	        ]
	    });

	$('.btn-add').click(function(){
		$('#modal-add').modal('show')
	})
	//bắt sự kiện submit form thêm mới
	$('#form-add').submit(function (e) {

		e.preventDefault();
		var url = $(this).attr('data-url');
		//alert(data);S
		
		$.ajax({
			//sử dụng phương thức post
			type: 'post',
			url: url,
			data: {
				name: $('#name').val(),
				quantity: $('#quantity').val(),
				color_id: $('#color_id').val(),
				price: $('#price').val(),
				life_expectancy: $('#life_expectancy').val(),
				product_id: $('#product_id').val(),
				status: $('#status').val(),
				slug: $('#slug').val(),
				sale_price: $('#sale_price').val(),
			},
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

// $(document).on('click', '.btn-detail', function (e) {
// 	e.preventDefault();
// 	$('#modal_show').modal('show');
// 		//lấy dữ liệu từ attribute data-url lưu vào biến url
// 		// var url=$(this).attr('href');
// 		var id = $(this).attr('data-id');
		
// 		$.ajax({
// 			//sử dụng phương thức get
// 			type: 'get',
// 			url: "/products/"+id,
// 			//nếu thực hiện thành công thì chạy vào success
// 			success: function (response) {
// 				// console.log(response.data.name);
// 				//hiển thị dữ liệu được controller trả về vào trong modal
// 				$('#name-show').text(response.data.name);
// 				$('#description-show').text(response.data.description);
				
// 			},
// 			error: function (jqXHR, textStatus, errorThrown) {
// 				//xử lý lỗi tại đây
// 			}
// 		})
// })



// $(document).on('click', '.btn-edit', function (e) {
// 	e.preventDefault();
// 			$('#modal-edit').modal('show');
// 			var id = $(this).data('id');
// 			$.ajax({
// 			type: 'get',
// 			url: 'products/' + id + '/edit',
// 			success: function(response){
// 				console.log(response.data);
// 				$('#id_edit').val(response.data.id);
// 				$('.description_edit').val(response.data.description);
// 				// $('.img-edit').append('<img src="/storage/'+response.data.thumbnail+'" style="width: 100px; height: 100px; border-radius: 12px;">')
// 				$('.name_edit').val(response.data.name);
// 				$('.slug_edit').val(response.data.slug);
// 				$('.user_id_edit').val(response.data.user_id);
// 				$('.category_id_edit').val(response.data.category_id);
// 			}
// 		})
// })

// $(document).submit('#form_edit', function(e){
// 	e.preventDefault();
// 	var id = $('#id_edit').val();
// 	// alert(id);
// 	 $.ajax({
// 		type: 'post',
// 		url: 'products/'+id,
// 		data: {
// 			name: $('#name_edit').val(),
// 			description: $('#description_edit').val(),
// 			slug: $('#slug_edit').val(),
// 			category_id: $('#category_id_edit').val(),
// 			user_id: $('#user_id_edit').val()
// 		},
// 		success: function(response){
// 			// //ẩn modal add đi
// 			$('#modal-edit').modal('hide');
// 			location.reload();
// 			toastr.success('save success!');
// 			// setTimeout(function () {
// 			// 	window.location.href= "post";
// 			// },1500);
// 		}
// 	})
// })

// $(document).on('click','.btn-delete',function(e){
// 	e.preventDefault();

// 	var id = $(this).data('id');
// 	$.ajax({
// 		//phương thức delete
// 		type: 'delete',
// 		url: 'products/'+id,
// 		data:{
// 			_token: $('meta[name="csrf-token"]').attr('content'),
// 		},
// 		success: function (response) {
// 			//thông báo xoá thành công bằng toastr
// 			location.reload();
// 			toastr.warning('delete todo success!')
// 		},
// 		error: function (error) {
			
// 		}
// 	})
// })
