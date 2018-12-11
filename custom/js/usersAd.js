var manageUsersAdTable;

$(document).ready(function() {
	// top bar active
	$('#navUsersAd').addClass('active');
	
	// manage users table
	manageUsersAdTable = $("#manageUsersAdTable").DataTable({
		'ajax': 'php_action/fetchUsersAd.php',
		'order': []

	});

	// submit usersAd form function
	$("#submitUsersAdForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			

		var usersAdName = $("#usersAdName").val();
		var password = $("#password").val();
		var email = $("#email").val();

		if(usersAdName == "") {
			$("#usersAdName").after('<p class="text-danger">Este campo es obligatorio</p>');
			$('#usersAdName').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#usersAdName").find('.text-danger').remove();
			// success out for form 
			$("#usersAdName").closest('.form-group').addClass('has-success');	  	
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

		if(usersAdName && password && email) {
			var form = $(this);
			// button loading
			$("#createUsersAdBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createUsersAdBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						manageUsersAdTable.ajax.reload(null, false);						

  	  			// reset the form text
						$("#submitUsersAdForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  					$('#add-usersAd-messages').html('<div class="alert alert-success">'+
        			    '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			            '</div>');

  	  					$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert
					} else {
						$('#add-usersAd-messages').html('<div class="alert alert-danger">'+
        			    '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-remove-sign"></i></strong> '+ response.messages +
			            '</div>');
					}

				} // /success
			}); // /ajax	
		} // if

		return false;
	}); // /submit usersAd form function

});

function editUsersAd(usersAdId = null) {

	if(usersAdId) {
		// remove hidden users id text
		$('#usersAdId').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-usersAd-result').addClass('div-hide');
		// modal footer
		$('.editUsersAdFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedUsersAd.php',
			type: 'post',
			data: {usersAdId : usersAdId},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-usersAd-result').removeClass('div-hide');
				// modal footer
				$('.editUsersAdFooter').removeClass('div-hide');

				console.log(response);
				// setting the username value 
				$('#editUsersAdName').val(response.username);
				// setting the users email value
				$('#editEmail').val(response.email);


				// users id 
				$(".editUsersAdFooter").after('<input type="hidden" name="usersAdId" id="usersAdId" value="'+response.user_id+'" />');

				// update users form 
				$('#editUsersAdForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var usersAdName = $('#editUsersAdName').val();
					var email = $('#editEmail').val();

					if(usersAdName == "") {
						$("#editUsersAdName").after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#editUsersAdName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editUsersAdName").find('.text-danger').remove();
						// success out for form 
						$("#editUsersAdName").closest('.form-group').addClass('has-success');	  	
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

					if(usersAdName && email) {
						var form = $(this);

						// submit btn
						$('#editUsersAdBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editUsersAdBtn').button('reset');

									// reload the manage member table 
									manageUsersAdTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  					$('#edit-usersAd-messages').html('<div class="alert alert-success">'+
						            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
						            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
							        '</div>');

			  	  					$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
								} else {
									$('#edit-usersAd-messages').html('<div class="alert alert-danger">'+
						            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
						            '<strong><i class="glyphicon glyphicon-remove-sign"></i></strong> '+ response.messages +
							        '</div>');
								}

									
							}// /success
						});	 // /ajax												
					} // /if

					return false;
				}); // /update usersAd form

			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /edit usersAd function

function editPassUsersAd(usersAdId = null) {

	// usersAd id 
	$(".editPassUsersAdFooter").after('<input type="hidden" name="usersAdId" id="usersAdId" value="'+usersAdId+'" />');

	// submit users form function
	$("#editPassUsersAdForm").unbind('submit').bind('submit', function() {
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
				$("#editPassUsersAdBtn").button('loading');

				$.ajax({
					url : form.attr('action'),
					type: form.attr('method'),
					data: form.serialize(),
					dataType: 'json',
					success:function(response) {
						// button loading
						$("#editPassUsersAdBtn").button('reset');
						console.log(response);
						if(response.success == true) {
							// reload the manage member table 
							manageUsersAdTable.ajax.reload(null, false);						

	  	  			// reset the form text
							$("#editPassUsersAdForm")[0].reset();
							// remove the error text
							$(".text-danger").remove();
							// remove the form error
							$('.form-group').removeClass('has-error').removeClass('has-success');
	  	  			
	  	  					$('#edit-usersAd-pass-messages').html('<div class="alert alert-success">'+
	            			'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            			'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
	          				'</div>');

	  	  			$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert
						}else{
							$('#edit-usersAd-pass-messages').html('<div class="alert alert-danger">'+
							'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
							'<strong>&times;</strong> '+ response.messages +
							'</div>');
						}

					} // /success
				}); // /ajax	
			}else{
				$('#edit-usersAd-pass-messages').html('<div class="alert alert-danger">'+
				'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				'<strong>&times;</strong> Las contraseña nueva del usuario no coinciden </div>');
			}
		} // if

		return false;
	}); // /submit users form function

} // /edit pass users function

function removeUsersAd(usersAdId = null) {
	if(usersAdId) {
		$('#removeUsersAdId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedUsersAd.php',
			type: 'post',
			data: {usersAdId : usersAdId},
			dataType: 'json',
			success:function(response) {
				$('.removeUsersAdFooter').after('<input type="hidden" name="removeUsersAdId" id="removeUsersAdId" value="'+response.user_id+'" /> ');

				// click on remove button to remove the usersAd
				$("#removeUsersAdBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeUsersAdBtn").button('loading');

					$.ajax({
						url: 'php_action/removeUsersAd.php',
						type: 'post',
						data: {usersAdId : usersAdId},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removeUsersAdBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#removeMemberModal').modal('hide');

								// reload the usersAd table 
								manageUsersAdTable.ajax.reload(null, false);
								
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
					}); // /ajax function to remove the usersAd

				}); // /click on remove button to remove the usersAd

			} // /success
		}); // /ajax

		$('.removeUsersAdFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove users function

function activeUsersAd(usersAdId = null) {
	if(usersAdId) {
		$('#activeUsersAdId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedUsersAd.php',
			type: 'post',
			data: {usersAdId : usersAdId},
			dataType: 'json',
			success:function(respons) {
				$('.activeUsersAdFooter').after('<input type="hidden" name="activeUsersAdId" id="activeUsersAdId" value="'+respons.user_id+'" /> ');
				// click on remove button to active the usersAd
				$("#activeUsersAdBtn").unbind('click').bind('click', function() {
					// button loading
					$("#activeUsersAdBtn").button('loading');

					$.ajax({
						url: 'php_action/activeUsersAd.php',
						type: 'post',
						data: {usersAdId : usersAdId},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#activeUsersAdBtn").button('reset');
							if(response.success == true) {

								// hide the active modal 
								$('#activeMemberModal').modal('hide');

								// reload the usersAd table 
								manageUsersAdTable.ajax.reload(null, false);
								
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
					}); // /ajax function to active the usersAd

				}); // /click on active button to active the usersAd

			} // /success
		}); // /ajax

		$('.activeUsersAdFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /active usersAd function