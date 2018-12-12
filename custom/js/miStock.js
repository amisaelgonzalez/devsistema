var manageMiStockTable;

$(document).ready(function() {
	// top nav bar 
	$('#navStockMenu').addClass('active');
	$('#topNavMiStock').addClass('active');
	// manage miStock data table
	manageMiStockTable = $('#manageMiStockTable').DataTable({
		'ajax': 'php_action/fetchMiStock.php',
		'order': []
	});

	// add miStock modal btn clicked
	$("#addMiStockModalBtn").unbind('click').bind('click', function() {
		// // miStock form reset
		$("#submitMiStockForm")[0].reset();		

		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');

		$("#miStockImage").fileinput({
	      overwriteInitial: true,
		    maxFileSize: 2500,
		    showClose: false,
		    showCaption: false,
		    browseLabel: '',
		    removeLabel: '',
		    browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
		    removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
		    removeTitle: 'Cancel or reset changes',
		    elErrorContainer: '#kv-avatar-errors-1',
		    msgErrorClass: 'alert alert-block alert-danger',
		    defaultPreviewContent: '<img src="assests/images/photo_default.png" alt="Profile Image" style="width:100%;">',
		    layoutTemplates: {main2: '{preview} {remove} {browse}'},								    
	  		allowedFileExtensions: ["jpg", "png", "gif", "JPG", "PNG", "GIF"]
			});   

		// submit miStock form
		$("#submitMiStockForm").unbind('submit').bind('submit', function() {

			// remove text-error 
			$(".text-danger").remove();
			// remove from-group error
			$(".form-group").removeClass('has-error').removeClass('has-success');
			
			// form validation
			var miStockImage = $("#miStockImage").val();
			var miStockName = $("#miStockName").val();
			var quantity = $("#quantity").val();
			var priceMenudeo = $("#priceMenudeo").val();
			var brandName = $("#brandName").val();
			var categoryName = $("#categoryName").val();
			var miStockStatus = $("#miStockStatus").val();
	
			if(miStockImage == "") {
				$("#miStockImage").closest('.center-block').after('<p class="text-danger">Este campo es obligatorio</p>');
				$('#miStockImage').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#miStockImage").find('.text-danger').remove();
				// success out for form 
				$("#miStockImage").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(miStockName == "") {
				$("#miStockName").after('<p class="text-danger">Este campo es obligatorio</p>');
				$('#miStockName').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#miStockName").find('.text-danger').remove();
				// success out for form 
				$("#miStockName").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(quantity == "") {
				$("#quantity").after('<p class="text-danger">Este campo es obligatorio</p>');
				$('#quantity').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#quantity").find('.text-danger').remove();
				// success out for form 
				$("#quantity").closest('.form-group').addClass('has-success');	  	
			}	// /else


			if(priceMenudeo == "") {
				$("#priceMenudeo").after('<p class="text-danger">Este campo es obligatorio</p>');
				$('#priceMenudeo').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#priceMenudeo").find('.text-danger').remove();
				// success out for form 
				$("#priceMenudeo").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(brandName == "") {
				$("#brandName").after('<p class="text-danger">Este campo es obligatorio</p>');
				$('#brandName').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#brandName").find('.text-danger').remove();
				// success out for form 
				$("#brandName").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(categoryName == "") {
				$("#categoryName").after('<p class="text-danger">Este campo es obligatorio</p>');
				$('#categoryName').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#categoryName").find('.text-danger').remove();
				// success out for form 
				$("#categoryName").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(miStockImage && miStockName && quantity && priceMenudeo && brandName && categoryName) {
				// submit loading button
				$("#createMiStockBtn").button('loading');

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

						if(response.success == true) {
							// submit loading button
							$("#createMiStockBtn").button('reset');
							
							$("#submitMiStockForm")[0].reset();

							$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																	
							// shows a successful message after operation
							$('#add-miStock-messages').html('<div class="alert alert-success">'+
		            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
		            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

							// remove the mesages
		          $(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert

		          // reload the manage student table
							manageMiStockTable.ajax.reload(null, true);

							// remove text-error 
							$(".text-danger").remove();
							// remove from-group error
							$(".form-group").removeClass('has-error').removeClass('has-success');

						} // /if response.success
						
					} // /success function
				}); // /ajax function
			}	 // /if validation is ok 					

			return false;
		}); // /submit miStock form

	}); // /add miStock modal btn clicked
	

	// remove miStock 	

}); // document.ready fucntion

function editMiStock(miStockId = null) {

	if(miStockId) {
		$("#miStockId").remove();		
		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');
		// modal spinner
		$('.div-loading').removeClass('div-hide');
		// modal div
		$('.div-result').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedMiStock.php',
			type: 'post',
			data: {miStockId: miStockId},
			dataType: 'json',
			success:function(response) {		
			// alert(response.miStock_image);
				// modal spinner
				$('.div-loading').addClass('div-hide');
				// modal div
				$('.div-result').removeClass('div-hide');				

				$("#getMiStockImage").attr('src', 'stock/'+response.product_image);

				$("#editMiStockImage").fileinput({		      
				});  

				// $("#editMiStockImage").fileinput({
		  //     overwriteInitial: true,
			 //    maxFileSize: 2500,
			 //    showClose: false,
			 //    showCaption: false,
			 //    browseLabel: '',
			 //    removeLabel: '',
			 //    browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
			 //    removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
			 //    removeTitle: 'Cancel or reset changes',
			 //    elErrorContainer: '#kv-avatar-errors-1',
			 //    msgErrorClass: 'alert alert-block alert-danger',
			 //    defaultPreviewContent: '<img src="stock/'+response.product_image+'" alt="Profile Image" style="width:100%;">',
			 //    layoutTemplates: {main2: '{preview} {remove} {browse}'},								    
		  // 		allowedFileExtensions: ["jpg", "png", "gif", "JPG", "PNG", "GIF"]
				// });  

				// stock id 
				$(".editMiStockFooter").append('<input type="hidden" name="miStockId" id="miStockId" value="'+response.stock_id+'" />');				
				$(".editMiStockPhotoFooter").append('<input type="hidden" name="miStockId" id="miStockId" value="'+response.stock_id+'" />');				
				
				// miStock name
				$("#editMiStockName").val(response.product_name);
				// quantity
				$("#editQuantity").val(response.quantity);
				// priceMenudeo
				$("#editPriceMenudeo").val(response.rate);
				// brand name
				$("#editBrandName").val(response.brand_id);
				// category name
				$("#editCategoryName").val(response.categories_id);

				// update the miStock data function
				$("#editMiStockForm").unbind('submit').bind('submit', function() {

					// form validation
					var miStockImage = $("#editMiStockImage").val();
					var miStockName = $("#editMiStockName").val();
					var quantity = $("#editQuantity").val();
					var priceMenudeo = $("#editPriceMenudeo").val();
					var brandName = $("#editBrandName").val();
					var categoryName = $("#editCategoryName").val();

					if(miStockName == "") {
						$("#editMiStockName").after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#editMiStockName').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editMiStockName").find('.text-danger').remove();
						// success out for form 
						$("#editMiStockName").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(quantity == "") {
						$("#editQuantity").after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#editQuantity').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editQuantity").find('.text-danger').remove();
						// success out for form 
						$("#editQuantity").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(priceMenudeo == "") {
						$("#editPriceMenudeo").after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#editPriceMenudeo').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editPriceMenudeo").find('.text-danger').remove();
						// success out for form 
						$("#editPriceMenudeo").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(brandName == "") {
						$("#editBrandName").after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#editBrandName').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editBrandName").find('.text-danger').remove();
						// success out for form 
						$("#editBrandName").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(categoryName == "") {
						$("#editCategoryName").after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#editCategoryName').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editCategoryName").find('.text-danger').remove();
						// success out for form 
						$("#editCategoryName").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(miStockName && quantity && priceMenudeo && brandName && categoryName) {
						// submit loading button
						$("#editMiStockBtn").button('loading');

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
							success:function(res) {
								console.log(res);
								if(res.success == true) {
									// submit loading button
									$("#editMiStockBtn").button('reset');																		

									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																			
									// shows a successful message after operation
									$('#edit-miStock-messages').html('<div class="alert alert-success">'+
				            		'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            		'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ res.messages +
				         			'</div>');

									// remove the mesages
				          			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert

				          			// reload the manage student table
									manageMiStockTable.ajax.reload(null, true);

									// remove text-error 
									$(".text-danger").remove();
									// remove from-group error
									$(".form-group").removeClass('has-error').removeClass('has-success');

								} // /if res.success
								
							} // /success function
						}); // /ajax function
					}	 // /if validation is ok 					

					return false;
				}); // update the miStock data function

				// update the miStock image				
				$("#updateMiStockImageForm").unbind('submit').bind('submit', function() {					
					// form validation
					var miStockImage = $("#editMiStockImage").val();					
					
					if(miStockImage == "") {
						$("#editMiStockImage").closest('.center-block').after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#editMiStockImage').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editMiStockImage").find('.text-danger').remove();
						// success out for form 
						$("#editMiStockImage").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(miStockImage) {
						// submit loading button
						$("#editMiStockImageBtn").button('loading');

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
							success:function(resImg) {
								
								if(resImg.success == true) {
									// submit loading button
									$("#editMiStockImageBtn").button('reset');																		

									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																			
									// shows a successful message after operation
									$('#edit-miStockPhoto-messages').html('<div class="alert alert-success">'+
				    	    	    '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
					    	        '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ resImg.messages +
						            '</div>');

									// remove the mesages
						          $(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert

							          // reload the manage student table
									manageMiStockTable.ajax.reload(null, true);

									$(".fileinput-remove-button").click();

									$.ajax({
										url: 'php_action/fetchMiStockImageUrl.php?i='+miStockId,
										type: 'post',
										success:function(resImg) {
										$("#getMiStockImage").attr('src', resImg);		
										}
									});																		

									// remove text-error 
									$(".text-danger").remove();
									// remove from-group error
									$(".form-group").removeClass('has-error').removeClass('has-success');

								} // /if resImg.success
								
							} // /success function
						}); // /ajax function
					}	 // /if validation is ok 					

					return false;
				}); // /update the miStock image

			} // /success function
		}); // /ajax to fetch miStock image

				
	} else {
		alert('error please refresh the page');
	}
} // /edit miStock function

// remove miStock 
function removeMiStock(miStockId = null) {
	if(miStockId) {
		// remove miStock button clicked
		$("#removeMiStockBtn").unbind('click').bind('click', function() {
			// loading remove button
			$("#removeMiStockBtn").button('loading');
			$.ajax({
				url: 'php_action/removeMiStock.php',
				type: 'post',
				data: {miStockId: miStockId},
				dataType: 'json',
				success:function(response) {
					// loading remove button
					$("#removeMiStockBtn").button('reset');
					if(response.success == true) {
						// remove miStock modal
						$("#removeMiStockModal").modal('hide');

						// update the miStock table
						manageMiStockTable.ajax.reload(null, false);

						// remove success messages
						$(".remove-messages").html('<div class="alert alert-success">'+
		            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
		            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

						// remove the mesages
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert
					} else {

						// remove success messages
						$(".removeMiStockMessages").html('<div class="alert alert-success">'+
		            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
		            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

						// remove the mesages
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert

					} // /error
				} // /success function
			}); // /ajax fucntion to remove the miStock
			return false;
		}); // /remove miStock btn clicked
	} // /if miStockid
} // /remove miStock function

function clearForm(oForm) {
	// var frm_elements = oForm.elements;									
	// console.log(frm_elements);
	// 	for(i=0;i<frm_elements.length;i++) {
	// 		field_type = frm_elements[i].type.toLowerCase();									
	// 		switch (field_type) {
	// 	    case "text":
	// 	    case "password":
	// 	    case "textarea":
	// 	    case "hidden":
	// 	    case "select-one":	    
	// 	      frm_elements[i].value = "";
	// 	      break;
	// 	    case "radio":
	// 	    case "checkbox":	    
	// 	      if (frm_elements[i].checked)
	// 	      {
	// 	          frm_elements[i].checked = false;
	// 	      }
	// 	      break;
	// 	    case "file": 
	// 	    	if(frm_elements[i].options) {
	// 	    		frm_elements[i].options= false;
	// 	    	}
	// 	    default:
	// 	        break;
	//     } // /switch
	// 	} // for
}

function descontarMiStock(miStockId = null) {

	if(miStockId) {
		$("#miStockId").remove();		
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
		$(".descontarMiStockFooter").append('<input type="hidden" name="miStockId" id="miStockId" value="'+miStockId+'" />');

		// update the descontarMiStock data function
		$("#descontarMiStockForm").unbind('submit').bind('submit', function() {

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
				$("#descontarMiStockBtn").button('loading');

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
							$("#descontarMiStockBtn").button('reset');																		
							// update the miStock table
							manageMiStockTable.ajax.reload(null, false);
							$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																	
							// shows a successful message after operation
							$('#descontar-miStock-messages').html('<div class="alert alert-success">'+
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
		}); // update the descontarMiStock data function

				
	} else {
		alert('error please refresh the page');
	}
} // /descontarMiStock function
