var manageSolicitudesTable;

$(document).ready(function() {
	// top nav bar 
	$('#navSolicitudes').addClass('active');
	// manage solicitudes data table
	manageSolicitudesTable = $('#manageSolicitudesTable').DataTable({
		'ajax': 'php_action/fetchSolicitudes.php',
		'order': []
	});

}); // document.ready fucntion


// aprobar traspaso
function aprobarTraspaso(solicitudId = null) {
	if(solicitudId) {
		// aprobar traspaso button clicked
		$("#aprobarTraspasoBtn").unbind('click').bind('click', function() {
			// loading remove button
			$("#aprobarTraspasoBtn").button('loading');
			$.ajax({
				url: 'php_action/aprobarTraspaso.php',
				type: 'post',
				data: {solicitudId: solicitudId},
				dataType: 'json',
				success:function(response) {
					// loading remove button
					$("#aprobarTraspasoBtn").button('reset');
					if(response.success == true) {
						// aprobar traspaso modal
						$("#aprobarTraspasoModal").modal('hide');

						// update the solicitudes table
						manageSolicitudesTable.ajax.reload(null, false);

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
						$(".removeAprobarTraspaso").html('<div class="alert alert-success">'+
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
			}); // /ajax fucntion to remove the traspaso
			return false;
		}); // /aprobar traspaso btn clicked
	} // /if solcitudid
} // /aprobar traspaso function


// cancelar traspaso
function cancelarTraspaso(solicitudId = null) {
	if(solicitudId) {
		// cancelar traspaso button clicked
		$("#cancelarTraspasoBtn").unbind('click').bind('click', function() {
			// loading remove button
			$("#cancelarTraspasoBtn").button('loading');
			$.ajax({
				url: 'php_action/cancelarTraspaso.php',
				type: 'post',
				data: {solicitudId: solicitudId},
				dataType: 'json',
				success:function(response) {
					// loading remove button
					$("#cancelarTraspasoBtn").button('reset');
					if(response.success == true) {
						// cancelar traspaso modal
						$("#cancelarTraspasoModal").modal('hide');

						// update the solicitudes table
						manageSolicitudesTable.ajax.reload(null, false);

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
						$(".removeCancelarTraspaso").html('<div class="alert alert-success">'+
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
			}); // /ajax fucntion to remove the traspaso
			return false;
		}); // /cancelar traspaso btn clicked
	} // /if solcitudid
} // /cancelar traspaso function
