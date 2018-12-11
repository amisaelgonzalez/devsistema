var manageMisSolicitudesTable;

$(document).ready(function() {
	// top nav bar 
	$('#navMisSolicitudes').addClass('active');
	// manage misSolicitudes data table
	manageMisSolicitudesTable = $('#manageMisSolicitudesTable').DataTable({
		'ajax': 'php_action/fetchMisSolicitudes.php',
		'order': []
	});

}); // document.ready fucntion

function editMisSolicitudes(misSolicitudesId = null) {

	if(misSolicitudesId) {
		$("#misSolicitudesId").remove();		
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
		// misSolicitudes id 
		$(".editMisSolicitudesFooter").append('<input type="hidden" name="misSolicitudesId" id="misSolicitudesId" value="'+misSolicitudesId+'" />');

		// update the misSolicitudes data function
		$("#editMisSolicitudesForm").unbind('submit').bind('submit', function() {

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
				$("#editMisSolicitudesBtn").button('loading');

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
							$("#editMisSolicitudesBtn").button('reset');																		

							$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																	
							// shows a successful message after operation
							$('#edit-misSolicitudes-messages').html('<div class="alert alert-success">'+
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
		}); // update the misSolicitudes data function

				
	} else {
		alert('error please refresh the page');
	}
} // /edit misSolicitudes function
