$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});
$(document).ready(function(){
	$('#products-table').DataTable({
		processing: true,
		serverSide: true,
		ajax: '/getproducts',
		columns: [
		{ data: 'id', name: 'id' },
		{ data: 'name', name: 'name' },
		{ data: 'description', name: 'description' },
		{ data: 'action', name: 'action' },
		]
	});

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


	$('#form-add').submit(function(e){
		var url = $(this).attr('data-url');
		var category_id;
		if(document.getElementById('main_product').checked){
			category_id = "1";
		}
		if(document.getElementById('byproduct').checked){
			category_id = "2";
		}
		e.preventDefault();
		var data = new FormData();
		data.append('_token', $('meta[name="csrf-token"]').attr('content'));
		data.append( 'name', $('#name').val());
		data.append( 'thumbnail', $('#thumbnail')[0].files[0]);
		data.append( 'description', $('#description').val());
		data.append( 'slug', $('#slug').val());
		data.append( 'category_id', category_id);
		console.log($('#thumbnail')[0].files[0]);
		$.ajax({
			//sử dụng phương thức post
			type: 'post',
			url: url,
			data: data,
			processData: false,
			contentType: false,
			success: function (response) {
				console.log(response.data);
				$('#modal-add').modal('hide');
				$('#products-table').DataTable().ajax.reload();
				toastr.success('save success!');
			},
			error: function (jqXHR, textStatus, errorThrown) {
				//xử lý lỗi tại đây
			}
		})
	})

	$('body').delegate('.btn-detail','click', function (e) {
		e.preventDefault();
		$('#appendimg').html('');
		$('#modal_show').modal('show');
			//lấy dữ liệu từ attribute data-url lưu vào biến url
			// var url=$(this).attr('href');
			var id = $(this).attr('data-id');
			
			$.ajax({
				//sử dụng phương thức get
				type: 'get',
				url: "/products/"+id,
				//nếu thực hiện thành công thì chạy vào success
				success: function (response) {
					console.log(response);
					$.each(response.data, function(key, value){
						$('#thumbnail-show').attr('src','/storage/' + value.thumbnail)
					})
					//hiển thị dữ liệu được controller trả về vào trong modal
					data = response.data;
					$('#name-show').text(data[0].name);
					$('#description-show').text(data[0].description);
					
				},
				error: function (jqXHR, textStatus, errorThrown) {
					//xử lý lỗi tại đây
				}
			})
		})

	$('body').delegate('.btn-edit', 'click', function (e) {
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
		e.preventDefault();
		$('#modal-edit').modal('show');
		var id = $(this).data('id');
		$.ajax({
			type: 'get',
			url: 'products/' + id + '/edit',
			success: function(response){
				console.log(response.data);
				$('#id_edit').val(response.data.id);
				$('.description_edit').val(response.data.description);
				// $('.img-edit').append('<img src="/storage/'+response.data.thumbnail+'" style="width: 100px; height: 100px; border-radius: 12px;">')
				$('.name_edit').val(response.data.name);
				$('.slug_edit').val(response.data.slug);
				$('.category_id_edit').val(response.data.category_id);
			}
		})
	})

	$('body').delegate('#form_edit','submit', function(e){
		var category_id;
		if(document.getElementById('main_product_edit').checked){
			category_id = "1";
		}
		if(document.getElementById('byproduct_edit').checked){
			category_id = "2";
		}
		e.preventDefault();

		var id = $('#id_edit').val();
		var data = new FormData();
		data.append('_token', $('meta[name="csrf-token"]').attr('content'));
		data.append( 'name', $('#name_edit').val());
		data.append( 'thumbnail', $('#thumbnail_edit')[0].files[0]);
		data.append( 'description', $('#description_edit').val());
		data.append( 'slug', $('#slug_edit').val());
		data.append( 'category_id', category_id);
		console.log($('#thumbnail_edit')[0].files[0]);
		// alert(id);
		$.ajax({
			type: 'post',
			url: 'products/'+id,
			data: data,
			processData: false,
			contentType: false,
			success: function(response){
				console.log(response.data);
				$('#modal-edit').modal('hide');
				$('#products-table').DataTable().ajax.reload();
				toastr.success('save success!');
				// setTimeout(function () {
				// 	window.location.href= "post";
				// },1500);
			}
		})
	})

	$('body').delegate('click','.btn-delete',function(e){
		e.preventDefault();

		var id = $(this).data('id');
		$.ajax({
			//phương thức delete
			type: 'delete',
			url: 'products/'+id,
			data:{
				_token: $('meta[name="csrf-token"]').attr('content'),
			},
			success: function (response) {
				//thông báo xoá thành công bằng toastr
				$('#products-table').DataTable().ajax.reload();
				toastr.warning('delete todo success!')
			},
			error: function (error) {
				
			}
		})
	})

	$('body').delegate('.btn-detail-product', 'click', function(e){
		e.preventDefault();
		$('#modal-detail-product').modal('show');
		var id = $(this).data('id');
		// alert(id);
		$('#btn-add-detail-product').attr('data-id', id);
		$('#detail-products-table').DataTable({
			processing: true,
			serverSide: true,
			destroy: true,
			ajax: '/getdetailproducts/'+id,
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

	})

	$('body').delegate('.btn-add-detail-product','click', function(e){
		$('#modal-add-detail-product').modal('show');
		function slug(str){
			var $slug = '';
			var trimmed = $.trim(str);
			$slug = trimmed.replace(/[^a-z0-9-]/gi, '-').replace(/-+/g, '-').replace(/^-|-$/g, '');
			return $slug.toLowerCase();
		}
		$('#name-detail-product').keyup(function(){
			var data = $('#name-detail-product').val()
			$('#slug-detail-product').val(slug(data));
		});
	})

	$('#form-add-detail-product').submit(function(e){
		var product_id = $('#btn-add-detail-product').data('id');

		var color_id;

		var url = $(this).attr('data-url');
		if(document.getElementById('redColor').checked){
			color_id = "1";
		}
		if(document.getElementById('blueColor').checked){
			color_id = "2";
		}
		if(document.getElementById('blackColor').checked){
			color_id = "3";
		}
		if(document.getElementById('greenColor').checked){
			color_id = "4";
		}
		if(document.getElementById('yellowColor').checked){
			color_id = "5";
		}

		var life_expectancy;

		if(document.getElementById('tuoi-dai').checked){
			life_expectancy = "Dài";
		}
		if(document.getElementById('tuoi-trung-binh').checked){
			life_expectancy = "Trung bình";
		}
		if(document.getElementById('tuoi-ngan').checked){
			life_expectancy = "Ngắn";
		}

		var status;

		if(document.getElementById('con-hang').checked){
			status = "2";
		}
		if(document.getElementById('gan-het').checked){
			status = "1";
		}
		if(document.getElementById('het-hang').checked){
			status = "0";
		}

		// alert(product_id);
		e.preventDefault();
		$.ajax({
			//sử dụng phương thức post
			type: 'post',
			url: url,
			data: {
				name: $('#name-detail-product').val(),
				quantity: $('#quantity-detail-product').val(),
				price: $('#price-detail-product').val(),
				sale_price: $('#sale-price-detail-product').val(),
				slug: $('#slug-detail-product').val(),
				product_id: product_id,
				color_id: color_id,
				life_expectancy: life_expectancy,
				status: status,
			},
			success: function (response) {
				$('#modal-add-detail-product').modal('hide');
				$('#detail-products-table').DataTable().ajax.reload();
				toastr.success('save success!');
			},
			error: function (jqXHR, textStatus, errorThrown) {
				//xử lý lỗi tại đây
			}
		})
	})

	$('body').delegate('.btn-edit-detail-product', 'click', function (e) {
		e.preventDefault();
		$('#modal-edit-detail-product').modal('show');
		var id = $(this).data('id');
		function slug(str){
			var $slug = '';
			var trimmed = $.trim(str);
			$slug = trimmed.replace(/[^a-z0-9-]/gi, '-').replace(/-+/g, '-').replace(/^-|-$/g, '');
			return $slug.toLowerCase();
		}
		$('#edit-name-detail-product').keyup(function(){
			var data = $('#edit-name-detail-product').val()
			$('#edit-slug-detail-product').val(slug(data));
		});
		$.ajax({
			type: 'get',
			url: 'detail-products/' + id + '/edit',
			success: function(response){
				console.log(response.data);
				$('#edit-id-detail-product').val(response.data.id);
				$('.edit-name-detail-product').val(response.data.name);
				// $('.img-edit').append('<img src="/storage/'+response.data.thumbnail+'" style="width: 100px; height: 100px; border-radius: 12px;">')
				$('.edit-quantity-detail-product').val(response.data.quantity);
				$('.edit-price-detail-product').val(response.data.price);
				$('.edit-sale-price-detail-product').val(response.data.sale_price);
				$('.edit-slug-detail-product').val(response.data.slug);
				$('.edit-product-id-detail-product').val(response.data.product_id);
			}
		})
		
		
	})

	$('body').delegate('#form-edit-detail-product','submit', function(e){


		var color_id;

		var url = $(this).attr('data-url');
		if(document.getElementById('edit-redColor').checked){
			color_id = "1";
		}
		if(document.getElementById('edit-blueColor').checked){
			color_id = "2";
		}
		if(document.getElementById('edit-blackColor').checked){
			color_id = "3";
		}
		if(document.getElementById('edit-greenColor').checked){
			color_id = "4";
		}
		if(document.getElementById('edit-yellowColor').checked){
			color_id = "5";
		}

		var life_expectancy;

		if(document.getElementById('edit-tuoi-dai').checked){
			life_expectancy = "Dài";
		}
		if(document.getElementById('edit-tuoi-trung-binh').checked){
			life_expectancy = "Trung bình";
		}
		if(document.getElementById('edit-tuoi-ngan').checked){
			life_expectancy = "Ngắn";
		}

		var status;

		if(document.getElementById('edit-con-hang').checked){
			status = "2";
		}
		if(document.getElementById('edit-gan-het').checked){
			status = "1";
		}
		if(document.getElementById('edit-het-hang').checked){
			status = "0";
		}
		e.preventDefault();
		var id = $('#edit-id-detail-product').val();
		// alert(id);
		console.log($('#edit-slug-detail-product').val());
		$.ajax({
			type: 'post',
			url: '/detail-products/'+id,
			data: {
				name: $('.edit-name-detail-product').val(),
				// $('.img-edit').append('<img src="/storage/'+response.data.thumbnail+'" style="width: 100px; height: 100px; border-radius: 12px;">')
				quantity: $('.edit-quantity-detail-product').val(),
				price: $('.edit-price-detail-product').val(),
				sale_price: $('.edit-sale-price-detail-product').val(),
				product_id: $('.edit-product-id-detail-product').val(),
				slug: $('.edit-slug-detail-product').val(),
				color_id: color_id,
				life_expectancy: life_expectancy,
				status: status,
			},
			success: function(response){
				// //ẩn modal add đi
				console.log(response.data.slug);
				$('#modal-edit-detail-product').modal('hide');
				$('#detail-products-table').DataTable().ajax.reload();
				toastr.success('save success!');
				// setTimeout(function () {
				// 	window.location.href= "post";
				// },1500);
			}
		})
	})

	$('body').delegate('.btn-show-detail-product','click', function (e) {
		e.preventDefault();
		$('#appendimg').html('');
		$('#modal_dtProduct_show').modal('show');
			//lấy dữ liệu từ attribute data-url lưu vào biến url
			// var url=$(this).attr('href');
			var id = $(this).attr('data-id');
			
			$.ajax({
				//sử dụng phương thức get
				type: 'get',
				url: "/detail-products/"+id,
				//nếu thực hiện thành công thì chạy vào success
				success: function (response) {
					console.log(response);
					$.each(response.data, function(key, value){
						$('#thumbnail-dtProduct-show').attr('src','/storage/' + value.thumbnail)
					})
					//hiển thị dữ liệu được controller trả về vào trong modal
					data = response.data;
					$('#name-dtProduct-show').text(data[0].name);
					$('#quantity-dtProduct-show').text(data[0].quantity);
					$('#price-dtProduct-show').text(data[0].price);
					$('#life-expectancy-dtProduct-show').text(data[0].life_expectancy);
					$('#sale-price-dtProduct-show').text(data[0].sale_price);
					
				},
				error: function (jqXHR, textStatus, errorThrown) {
					//xử lý lỗi tại đây
				}
			})
		})

	$('body').delegate('.btn-delete-detail-product','click',function(e){
		e.preventDefault();

		var id = $(this).data('id');
		$.ajax({
			//phương thức delete
			type: 'delete',
			url: 'detail-products/'+id,
			data:{
				_token: $('meta[name="csrf-token"]').attr('content'),
			},
			success: function (response) {
				//thông báo xoá thành công bằng toastr
				$('#detail-products-table').DataTable().ajax.reload();
				toastr.warning('delete todo success!')
			},
			error: function (error) {
				
			}
		})
	})

	$('body').delegate('.btn-add-img-detail-product', 'click', function(e){
		$('#modal_add_img').modal('show');
		var id = $(this).data('id');
		$.ajax({
			type: 'get',
			url: '/upload-img/' + id,
			success: function(response){
				console.log(response.data);
				$('#product_id').val(response.data.id);
			}
		})
	})

})

