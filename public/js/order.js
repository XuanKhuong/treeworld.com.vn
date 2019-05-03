$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function(){
	$('#orders-table').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: '/getorders',
	        columns: [
	            { data: 'id', name: 'id' },
	            { data: 'name_customer', name: 'name_customer' },
	            { data: 'address_customer', name: 'address_customer' },
	            { data: 'mobile_customer', name: 'mobile_customer' },
	            { data: 'total', name: 'total' },
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
				name_customer: $('#name-customer').val(),
				address_customer: $('#address-customer').val(),
				mobile_customer: $('#mobile-customer').val(),
				customer_id: $('#customer-id').val(),
				status: $('#status').val(),
				employee_id: $('#employee-id').val(),
				total: $('#total').val(),
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
			url: "/orders/"+id,
			//nếu thực hiện thành công thì chạy vào success
			success: function (response) {
				console.log(response.data.address);
				//hiển thị dữ liệu được controller trả về vào trong modal
				$('#name-customer-show').text(response.data.name_customer);				
				$('#address-customer-show').text(response.data.address_customer);				
				$('#mobile-customer-show').text(response.data.mobile_customer);				
				$('#customer-id-show').text(response.data.customer_id);				
				$('#status-show').text(response.data.status);				
				$('#employee-id-show').text(response.data.employee_id);				
				$('#total-show').text(response.data.total);				
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
			url: 'orders/' + id + '/edit',
			success: function(response){
				$('#name-customer_edit').val(response.data.name_customer);				
				$('#address-customer_edit').val(response.data.address_customer);				
				$('#mobile-customer_edit').val(response.data.mobile_customer);				
				$('#customer-id_edit').val(response.data.customer_id);				
				$('#status_edit').val(response.data.status);				
				$('#employee-id_edit').val(response.data.employee_id);				
				$('#total_edit').val(response.data.total);	
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
		url: '/orders/'+id,
		data: {
			name_customer: $('#name-customer_edit').val(),
			address_customer: $('#address-customer_edit').val(),
			mobile_customer: $('#mobile-customer_edit').val(),
			customer_id: $('#customer-id_edit').val(),
			status: $('#status_edit').val(),
			employee_id: $('#employee-id_edit').val(),
			total: $('#total_edit').val(),
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
		url: 'orders/'+id,
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