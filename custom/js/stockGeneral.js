var manageStockGeneralTable;

$(document).ready(function() {
	// top nav bar 
	$('#navStockMenu').addClass('active');
	$('#topNavStockGeneral').addClass('active');
	// manage stockGeneral data table
	manageStockGeneralTable = $('#manageStockGeneralTable').DataTable({
		'ajax': 'php_action/fetchStockGeneral.php',
		'order': []
	});

}); // document.ready fucntion

function editStockGeneral(stockGeneralId = null) {

	if(stockGeneralId) {
		$("#stockGeneralId").remove();		
		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');
		// modal spinner
		$('.div-loading').removeClass('div-hide');
		// modal div
		$('.div-result').addClass('div-hide');

		// modal spinner
		$('.div-loading').addClass('div-hide');
		// modal div
		$('.div-result').removeClass('div-hide')
		// tockGeneral id 
		$(".editStockGeneralFooter").append('<input type="hidden" name="stockGeneralId" id="stockGeneralId" value="'+stockGeneralId+'" />');

		// update the stockGeneral data function
		$("#editStockGeneralForm").unbind('submit').bind('submit', function() {

			// form validation
			var quantity = $("#editQuantity").val();

			if(quantity == "") {
				$("#editQuantity").after('<p class="text-danger">Este campo es obligatorio</p>');
				$('#editQuantity').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#editQuantity").find('.text-danger').remove();
				// success out for form 
				$("#editQuantity").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(quantity) {
				// submit loading button
				$("#editStockGeneralBtn").button('loading');

				var form = $(this);
				var formData = new FormData(this);

				$.ajax({
					url : form.attr('action'),
					type: form.attr('method'),
					data: formData,
					dataType: 'json',
					cache: false,
					contentType: false,
					processData: false,
					success:function(response) {
						console.log(response);
						if(response.success == true) {
							// submit loading button
							$("#editStockGeneralBtn").button('reset');																		

							$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																	
							// shows a successful message after operation
							$('#edit-stockGeneral-messages').html('<div class="alert alert-success">'+
		            		'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
		            		'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
					        '</div>');

							// remove the mesages
				            $(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert

							// remove text-error 
							$(".text-danger").remove();
							// remove from-group error
							$(".form-group").removeClass('has-error').removeClass('has-success');

						} // /if response.success
						
					} // /success function
				}); // /ajax function
			}	 // /if validation is ok 					

			return false;
		}); // update the stockGeneral data function

				
	} else {
		alert('error please refresh the page');
	}
} // /edit stockGeneral function
