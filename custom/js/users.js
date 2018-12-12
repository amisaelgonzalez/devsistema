var manageUsersTable;

$(document).ready(function() {
	// top bar active
	$('#navUsers').addClass('active');
	
	// manage users table
	manageUsersTable = $("#manageUsersTable").DataTable({
		'ajax': 'php_action/fetchUsers.php',
		'order': []		
		
		
	});

	// submit users form function
	$("#submitUsersForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			

		var usersName = $("#usersName").val();
		var password = $("#password").val();
		var email = $("#email").val();
		var rol = $("#rol").val();
		var sucursal = $("#sucursal").val();

		if(usersName == "") {
			$("#usersName").after('<p class="text-danger">Este campo es obligatorio</p>');
			$('#usersName').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#usersName").find('.text-danger').remove();
			// success out for form 
			$("#usersName").closest('.form-group').addClass('has-success');	  	
		}

		if(password == "") {
			$("#password").after('<p class="text-danger">Este campo es obligatorio</p>');

			$('#password').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#password").find('.text-danger').remove();
			// success out for form 
			$("#password").closest('.form-group').addClass('has-success');	  	
		}

		if(email == "") {
			$("#email").after('<p class="text-danger">Este campo es obligatorio</p>');

			$('#email').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#email").find('.text-danger').remove();
			// success out for form 
			$("#email").closest('.form-group').addClass('has-success');	  	
		}

		if(rol == "") {
			$("#rol").after('<p class="text-danger">Este campo es obligatorio</p>');

			$('#rol').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#rol").find('.text-danger').remove();
			// success out for form 
			$("#rol").closest('.form-group').addClass('has-success');	  	
		}

		requireSucursal = true;
		if(rol == 2 && sucursal == "") {
			requireSucursal = false;
			$("#sucursal").after('<p class="text-danger">Este campo es obligatorio</p>');

			$('#sucursal').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#sucursal").find('.text-danger').remove();
			// success out for form 
			$("#sucursal").closest('.form-group').addClass('has-success');	  	
		}

		if(usersName && password && email && rol && requireSucursal) {
			var form = $(this);
			// button loading
			$("#createUsersBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createUsersBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						manageUsersTable.ajax.reload(null, false);						

  	  					// reset the form text
						$("#submitUsersForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
			  			$('#add-users-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			            '</div>');

		  	  			$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert
					} else {
						$('#add-users-messages').html('<div class="alert alert-danger">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-remove-sign"></i></strong> '+ response.messages +
			            '</div>');
					}

				} // /success
			}); // /ajax	
		} // if

		return false;
	}); // /submit users form function

});

function habilitarCombo(valor){

	if(valor==2 || valor==3){
		document.getElementById("divSucursal").style.display = 'block';
		document.getElementById("divEditSucursal").style.display = 'block';
	} else {
		document.getElementById("divSucursal").style.display = 'none'; 
		document.getElementById("divEditSucursal").style.display = 'none'; 
	}
}

function editUsers(usersId = null) {

	if(usersId) {
		// remove hidden users id text
		$('#usersId').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-users-result').addClass('div-hide');
		// modal footer
		$('.editUsersFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedUsers.php',
			type: 'post',
			data: {usersId : usersId},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-users-result').removeClass('div-hide');
				// modal footer
				$('.editUsersFooter').removeClass('div-hide');

				console.log(response);
				// setting the username value 
				$('#editUsersName').val(response.username);
				// setting the users email value
				$('#editEmail').val(response.email);
				// setting the users rol value
				$('#editRol').val(response.rol);
				// setting the users sucursal value
				$('#editSucursal').val(response.sucursales_id);
				if (response.rol == 2 || response.rol == 3) {
					habilitarCombo(response.rol);
				}else{
					habilitarCombo(1);
				}

				// users id 
				$(".editUsersFooter").after('<input type="hidden" name="usersId" id="usersId" value="'+response.user_id+'" />');

				// update users form 
				$('#editUsersForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var usersName = $('#editUsersName').val();
					var email = $('#editEmail').val();
					var rol = $('#editRol').val();
					var editSucursal = $('#editSucursal').val();


					if(usersName == "") {
						$("#editUsersName").after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#editUsersName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editUsersName").find('.text-danger').remove();
						// success out for form 
						$("#editUsersName").closest('.form-group').addClass('has-success');	  	
					}

					if(email == "") {
						$("#editEmail").after('<p class="text-danger">Este campo es obligatorio</p>');

						$('#editEmail').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editEmail").find('.text-danger').remove();
						// success out for form 
						$("#editEmail").closest('.form-group').addClass('has-success');	  	
					}

					if(rol == "") {
						$("#editRol").after('<p class="text-danger">Este campo es obligatorio</p>');

						$('#editRol').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editRol").find('.text-danger').remove();
						// success out for form 
						$("#editRol").closest('.form-group').addClass('has-success');	  	
					}
					console.log(editSucursal);
					requireSucursal = true;
					if(rol == 2 && (editSucursal == "" || editSucursal == null)) {
						requireSucursal = false;
						$("#editSucursal").after('<p class="text-danger">Este campo es obligatorio</p>');

						$('#editSucursal').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editSucursal").find('.text-danger').remove();
						// success out for form 
						$("#editSucursal").closest('.form-group').addClass('has-success');	  	
					}

					if(usersName && email && rol && requireSucursal) {
						var form = $(this);

						// submit btn
						$('#editUsersBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(res) {

								if(res.success == true) {
									// submit btn
									$('#editUsersBtn').button('reset');

									// reload the manage member table 
									manageUsersTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
						  	  		$('#edit-users-messages').html('<div class="alert alert-success">'+
						            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
						            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ res.messages +
						            '</div>');

			  	  					$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
								} else{
									$('#edit-users-messages').html('<div class="alert alert-danger">'+
						            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
						            '<strong><i class="glyphicon glyphicon-remove-sign"></i></strong> '+ res.messages +
						            '</div>');
								}
							}// /success
						});	 // /ajax												
					} // /if

					return false;
				}); // /update users form

			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /edit users function

function editPassUsers(usersId = null) {

	// users id 
	$(".editPassUsersFooter").after('<input type="hidden" name="usersId" id="usersId" value="'+usersId+'" />');

	// submit users form function
	$("#editPassUsersForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			

		var passwordAdmin = $("#passwordAdmin").val();
		var password1 = $("#password1").val();
		var password2 = $("#password2").val();

		if(passwordAdmin == "") {
			$("#passwordAdmin").after('<p class="text-danger">Este campo es obligatorio</p>');
			$('#passwordAdmin').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#passwordAdmin").find('.text-danger').remove();
			// success out for form 
			$("#passwordAdmin").closest('.form-group').addClass('has-success');	  	
		}

		if(password1 == "") {
			$("#password1").after('<p class="text-danger">Este campo es obligatorio</p>');

			$('#password1').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#password1").find('.text-danger').remove();
			// success out for form 
			$("#password1").closest('.form-group').addClass('has-success');	  	
		}

		if(password2 == "") {
			$("#password2").after('<p class="text-danger">Este campo es obligatorio</p>');

			$('#password2').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#password2").find('.text-danger').remove();
			// success out for form 
			$("#password2").closest('.form-group').addClass('has-success');	  	
		}
		if(passwordAdmin && password1 && password2) {
			if (password1 == password2) {
				var form = $(this);
				// button loading
				$("#editPassUsersBtn").button('loading');

				$.ajax({
					url : form.attr('action'),
					type: form.attr('method'),
					data: form.serialize(),
					dataType: 'json',
					success:function(response) {
						// button loading
						$("#editPassUsersBtn").button('reset');
						console.log(response);
						if(response.success == true) {
							// reload the manage member table 
							manageUsersTable.ajax.reload(null, false);						

	  	  			// reset the form text
							$("#editPassUsersForm")[0].reset();
							// remove the error text
							$(".text-danger").remove();
							// remove the form error
							$('.form-group').removeClass('has-error').removeClass('has-success');
	  	  			
	  	  					$('#edit-users-pass-messages').html('<div class="alert alert-success">'+
	            			'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            			'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
	          				'</div>');

	  	  			$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert
						}else{
							$('#edit-users-pass-messages').html('<div class="alert alert-danger">'+
							'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
							'<strong>&times;</strong> '+ response.messages +
							'</div>');
						}

					} // /success
				}); // /ajax	
			}else{
				$('#edit-users-pass-messages').html('<div class="alert alert-danger">'+
				'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				'<strong>&times;</strong> Las contraseña nueva del usuario no coinciden </div>');
			}
		} // if

		return false;
	}); // /submit users form function

} // /edit pass users function

function removeUsers(usersId = null) {
	if(usersId) {
		$('#removeUsersId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedUsers.php',
			type: 'post',
			data: {usersId : usersId},
			dataType: 'json',
			success:function(response) {
				$('.removeUsersFooter').after('<input type="hidden" name="removeUsersId" id="removeUsersId" value="'+response.user_id+'" /> ');

				// click on remove button to remove the users
				$("#removeUsersBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeUsersBtn").button('loading');

					$.ajax({
						url: 'php_action/removeUsers.php',
						type: 'post',
						data: {usersId : usersId},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removeUsersBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#removeMemberModal').modal('hide');

								// reload the users table 
								manageUsersTable.ajax.reload(null, false);
								
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
					}); // /ajax function to remove the users

				}); // /click on remove button to remove the users

			} // /success
		}); // /ajax

		$('.removeUsersFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove users function

function activeUsers(usersId = null) {
	if(usersId) {
		$('#activeUsersId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedUsers.php',
			type: 'post',
			data: {usersId : usersId},
			dataType: 'json',
			success:function(response) {
				$('.activeUsersFooter').after('<input type="hidden" name="activeUsersId" id="activeUsersId" value="'+response.user_id+'" /> ');

				// click on remove button to active the users
				$("#activeUsersBtn").unbind('click').bind('click', function() {
					// button loading
					$("#activeUsersBtn").button('loading');

					$.ajax({
						url: 'php_action/activeUsers.php',
						type: 'post',
						data: {usersId : usersId},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#activeUsersBtn").button('reset');
							if(response.success == true) {

								// hide the active modal 
								$('#activeMemberModal').modal('hide');

								// reload the users table 
								manageUsersTable.ajax.reload(null, false);
								
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
					}); // /ajax function to active the users

				}); // /click on active button to active the users

			} // /success
		}); // /ajax

		$('.activeUsersFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /active users function