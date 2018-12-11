var managePedidoTable;
var brandId = $("#id").val();
$(document).ready(function() {
	// top bar active
	$('#navPedido').addClass('active');

	// manage pedido table
	managePedidoTable = $("#managePedidoTable").DataTable({
		'ajax': 'php_action/fetchPedido.php?proveedor_id='+brandId,
		'order': []		
	});

	console.log(managePedidoTable);
	// submit pedido form function
	$("#submitPedidoForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			

		var brandName = $("#brandName").val();
		var pedidoName = $("#pedidoName").val();

		if(brandName == "") {
			$("#brandName").after('<p class="text-danger">Este campo es obligatorio</p>');
			$('#brandName').closest('.form-group').addClass('has-error');
		}	else {
			// remov error text field
			$("#brandName").find('.text-danger').remove();
			// success out for form 
			$("#brandName").closest('.form-group').addClass('has-success');	  	
		}	// /else

		if(pedidoName == "") {
			$("#pedidoName").after('<p class="text-danger">Este campo es obligatorio</p>');
			$('#pedidoName').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#pedidoName").find('.text-danger').remove();
			// success out for form 
			$("#pedidoName").closest('.form-group').addClass('has-success');	  	
		}

		if(pedidoName && brandName) {
			var form = $(this);
			// button loading
			$("#createPedidoBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createPedidoBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						managePedidoTable.ajax.reload(null, false);						

				// reset the form text
						$("#submitPedidoForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
				
				$('#add-pedido-messages').html('<div class="alert alert-success">'+
			'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		  '</div>');

				$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert
					}  // if

				} // /success
			}); // /ajax	
		} // if

		return false;
	}); // /submit pedido form function

});
/*
function addPedido() {
	// pedido id 
	$(".addPedidoFooter").after('<input type="hidden" name="brandId" id="brandId" value="'+brandId+'" />');
} // /add pedido function*/

function editPedido(pedidoId = null) {
	if(pedidoId) {
		// remove hidden pedido id text
		$('#pedidoId').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-pedido-result').addClass('div-hide');
		// modal footer
		$('.editPedidoFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedPedido.php',
			type: 'post',
			data: {pedidoId : pedidoId},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-pedido-result').removeClass('div-hide');
				// modal footer
				$('.editPedidoFooter').removeClass('div-hide');

				// setting the pedido name value 
				$('#editPedidoName').val(response.pedido_name);
				// brand name
				$("#editBrandName").val(response.brand_id);				
				// pedido id 
				$(".editPedidoFooter").after('<input type="hidden" name="pedidoId" id="pedidoId" value="'+response.pedido_id+'" />');

				// update pedido form 
				$('#editPedidoForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var brandName = $("#editBrandName").val();
					var pedidoName = $('#editPedidoName').val();
					
					if(brandName == "") {
						$("#editBrandName").after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#editBrandName').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editBrandName").find('.text-danger').remove();
						// success out for form 
						$("#editBrandName").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(pedidoName == "") {
						$("#editPedidoName").after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#editPedidoName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editPedidoName").find('.text-danger').remove();
						// success out for form 
						$("#editPedidoName").closest('.form-group').addClass('has-success');	  	
					}

					if(pedidoName && brandName) {
						var form = $(this);

						// submit btn
						$('#editPedidoBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editPedidoBtn').button('reset');

									// reload the manage member table 
									managePedidoTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
							
							$('#edit-pedido-messages').html('<div class="alert alert-success">'+
						'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
						'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
					  '</div>');

							$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
								} // /if
									
							}// /success
						});	 // /ajax												
					} // /if

					return false;
				}); // /update pedido form

			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /edit pedido function

function removePedido(pedidoId = null) {
	if(pedidoId) {
		$('#removePedidoId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedPedido.php',
			type: 'post',
			data: {pedidoId : pedidoId},
			dataType: 'json',
			success:function(response) {
				$('.removePedidoFooter').after('<input type="hidden" name="removePedido" id="removePedidoId" value="'+response.pedido_id+'" /> ');

				// click on remove button to remove the pedido
				$("#removePedidoBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removePedidoBtn").button('loading');

					$.ajax({
						url: 'php_action/removePedido.php',
						type: 'post',
						data: {pedidoId : pedidoId},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removePedidoBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#removeMemberModal').modal('hide');

								// reload the pedido table 
								managePedidoTable.ajax.reload(null, false);
								
								$('.remove-messages').html('<div class="alert alert-success">'+
						'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
						'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
					  '</div>');

							$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
							} else {

							} // /else
						} // /response messages
					}); // /ajax function to remove the pedido

				}); // /click on remove button to remove the pedido

			} // /success
		}); // /ajax

		$('.removePedidoFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove pedido function