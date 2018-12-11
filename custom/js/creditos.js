var manageCreditosTable;

$(document).ready(function() {
	// top bar active
	$('#navCreditos').addClass('active');
	
	// manage creditos table
	manageCreditosTable = $("#manageCreditosTable").DataTable({
		'ajax': 'php_action/fetchCreditos.php',
		'order': []
	});

	$("#creditosFechaLimite").datepicker();

	// submit creditos form function
	$("#submitCreditosForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			

		var creditosCantidad = $("#creditosCantidad").val();
		var sucursalId = $("#sucursalId").val();
		var creditosFechaLimite = $("#creditosFechaLimite").val();
		var decimal = true;
		if(creditosCantidad == "") {
			$("#creditosCantidad").after('<p class="text-danger">Este campo es obligatorio</p>');
			$('#creditosCantidad').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#creditosCantidad").find('.text-danger').remove();
			// success out for form 
			$("#creditosCantidad").closest('.form-group').addClass('has-success');	  	
			
			$('input#creditosCantidad').blur(function(){
		    var num = parseFloat($(this).val());
		    var cleanNum = num.toFixed(2);
		    $(this).val(cleanNum);
		    	if(num/cleanNum < 1){
		    		decimal = false;
					$("#creditosCantidad").after('<p class="text-danger">Este campo requiere 2 decimales</p>');
					$('#creditosCantidad').closest('.form-group').addClass('has-error');
		        }
		    });
		}

		if(sucursalId == "") {
			$("#sucursalId").after('<p class="text-danger">Este campo es obligatorio</p>');

			$('#sucursalId').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#sucursalId").find('.text-danger').remove();
			// success out for form 
			$("#sucursalId").closest('.form-group').addClass('has-success');	  	
		}

		if(creditosFechaLimite == "") {
			$("#creditosFechaLimite").after('<p class="text-danger">Este campo es obligatorio</p>');

			$('#creditosFechaLimite').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#creditosFechaLimite").find('.text-danger').remove();
			// success out for form 
			$("#creditosFechaLimite").closest('.form-group').addClass('has-success');	  	
		}

		if(creditosCantidad && sucursalId && creditosFechaLimite && decimal) {
			var form = $(this);
			// button loading
			$("#createCreditosBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createCreditosBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						manageCreditosTable.ajax.reload(null, false);						

  	  			// reset the form text
						$("#submitCreditosForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			$('#add-creditos-messages').html('<div class="alert alert-success">'+
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
	}); // /submit creditos form function

});

function setTwoNumberDecimal(event) {
    this.value = parseFloat(this.value).toFixed(2);
}

function editCreditos(creditosId = null) {

	$("#editCreditosFechaLimite").datepicker();

	if(creditosId) {
		// remove hidden creditos id text
		$('#creditosId').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-creditos-result').addClass('div-hide');
		// modal footer
		$('.editCreditosFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedCreditos.php',
			type: 'post',
			data: {creditosId : creditosId},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-creditos-result').removeClass('div-hide');
				// modal footer
				$('.editCreditosFooter').removeClass('div-hide');

				// setting the creditos name value 
				$('#editCreditosCantidad').val(response.creditos_cantidad);
				// setting the sucursal id value
				$('#editSucursalId').val(response.sucursales_id);
				// setting the creditos fecha limte value
				$('#editCreditosFechaLimite').val(response.creditos_fecha_limite);
				
				// creditos id 
				$(".editCreditosFooter").after('<input type="hidden" name="creditosId" id="creditosId" value="'+response.creditos_id+'" />');

				// update creditos form 
				$('#editCreditosForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var creditosCantidad = $('#editCreditosCantidad').val();
					var sucursalId = $('#editSucursalId').val();

					if(creditosCantidad == "") {
						$("#editCreditosCantidad").after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#editCreditosCantidad').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editCreditosCantidad").find('.text-danger').remove();
						// success out for form 
						$("#editCreditosCantidad").closest('.form-group').addClass('has-success');	  	
					}

					if(sucursalId == "") {
						$("#editSucursalId").after('<p class="text-danger">Este campo es obligatorio</p>');

						$('#editSucursalId').closest('.form-group').addClass('has-error');
					} else {
						// remove error text field
						$("#editSucursalId").find('.text-danger').remove();
						// success out for form 
						$("#editSucursalId").closest('.form-group').addClass('has-success');	  	
					}

					if(editCreditosFechaLimite == "") {
						$("#editCreditosFechaLimite").after('<p class="text-danger">Este campo es obligatorio</p>');

						$('#editCreditosFechaLimite').closest('.form-group').addClass('has-error');
					} else {
						// remove error text field
						$("#editCreditosFechaLimite").find('.text-danger').remove();
						// success out for form 
						$("#editCreditosFechaLimite").closest('.form-group').addClass('has-success');	  	
					}

					if(creditosCantidad && sucursalId && editCreditosFechaLimite) {
						var form = $(this);

						// submit btn
						$('#editCreditosBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editCreditosBtn').button('reset');

									// reload the manage member table 
									manageCreditosTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-creditos-messages').html('<div class="alert alert-success">'+
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
				}); // /update creditos form

			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /edit creditos function

function removeCreditos(creditosId = null) {
	if(creditosId) {
		$('#removeCreditosId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedCreditos.php',
			type: 'post',
			data: {creditosId : creditosId},
			dataType: 'json',
			success:function(response) {
				$('.removeCreditosFooter').after('<input type="hidden" name="removeCreditosId" id="removeCreditosId" value="'+response.creditos_id+'" /> ');

				// click on remove button to remove the creditos
				$("#removeCreditosBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeCreditosBtn").button('loading');

					$.ajax({
						url: 'php_action/removeCreditos.php',
						type: 'post',
						data: {creditosId : creditosId},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removeCreditosBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#removeMemberModal').modal('hide');

								// reload the creditos table 
								manageCreditosTable.ajax.reload(null, false);
								
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
					}); // /ajax function to remove the creditos

				}); // /click on remove button to remove the creditos

			} // /success
		}); // /ajax

		$('.removeCreditosFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove creditos function

