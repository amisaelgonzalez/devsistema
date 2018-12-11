var manageStockPorSucursalTable;
$(document).ready(function() {
	// top nav bar 
	$('#navStockPorSucursal').addClass('active');
	// manage stockPorSucursal data table
	manageStockPorSucursalTable = $('#manageStockPorSucursalTable').DataTable({
		ajax: {
    		url : "php_action/fetchStockPorSucursal.php",
	        type: "POST",
			data : function(data) {
				  data.SucursalId = $('#sucursal').val();
			}
		},
		order: []
	});

}); // document.ready fucntion

function buscarScursal() {
	manageStockPorSucursalTable.ajax.reload(null, false);
}

function solicitarTraspaso(stockPorSucursalId = null) {

	var sucursalId = $('#sucursal').val();
	if(stockPorSucursalId) {
		$("#stockPorSucursalId").remove();		
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
		// stockPorSucursal id 
		$(".solicitarTraspasoFooter").append('<input type="hidden" name="stockPorSucursalId" id="stockPorSucursalId" value="'+stockPorSucursalId+'" />');
		// stockPorSucursal id 
		$(".solicitarTraspasoFooter").append('<input type="hidden" name="sucursalId" id="sucursalId" value="'+sucursalId+'" />');

		// update the solicitarTraspaso data function
		$("#solicitarTraspasoForm").unbind('submit').bind('submit', function() {

			// form validation
			var cantidad = $("#cantidad").val();

			if(cantidad == "") {
				$("#cantidad").after('<p class="text-danger">Este campo es obligatorio</p>');
				$('#cantidad').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#cantidad").find('.text-danger').remove();
				// success out for form 
				$("#cantidad").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(cantidad) {
				// submit loading button
				$("#solicitarTraspasoBtn").button('loading');

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
							$("#solicitarTraspasoBtn").button('reset');																		

							$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																	
							// shows a successful message after operation
							$('#edit-solicitarTraspaso-messages').html('<div class="alert alert-success">'+
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
		}); // update the solicitarTraspaso data function

				
	} else {
		alert('error please refresh the page');
	}
} // /solicitarTraspaso function
