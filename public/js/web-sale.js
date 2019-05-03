$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

$(document).ready(function(){
	$('body').delegate('#btn-order', 'click', function(e){
		$('#modal-info').modal('show');
	})

	$('body').delegate('#form-info', 'submit', function(e){
		e.preventDefault();
		var url = $(this).attr('data-url');

		$.ajax({
			type: 'post',
			url: url,
			data:{
				name_customer: $('#name').val(),
				address_customer: $('#address').val(),
				mobile_customer: $('#phone_number').val(),
			},
			success: function (response) {
				$('#modal-info').modal('hide');
				setTimeout(function () {
					window.location.href= "cart";
				},2000);
				toastr.success('buy success!');
			},
			error: function (jqXHR, textStatus, errorThrown) {
				//xử lý lỗi tại đây
			}		
		})
	})
})