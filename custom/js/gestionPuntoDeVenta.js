//Tabla Gstion Ventas
var manageOrderTableVentas;
//Tabla Gstion Consinaciones
var manageOrderTableConsig;

$(document).ready(function() {

	$('.js-example-basic-single').select2();

	var user_id = $('input#userIdFilter').val();
	console.log("user_id:",user_id);

	// top nav bar 
	$('#navOrderPdv').addClass('active');
	// sub manin
	$("#topNavManageOrderPdv").addClass('active');
	// manage ventas data table
	manageOrderTableVentas = $('#manageOrderTableVentas').DataTable({
	    "ajax": {
	        'type': 'POST',
	        'url': 'php_action/pdv/fetchPuntoDeVenta.php',
	        'data': {
	           data: user_id
	        },
	    },
		'order': []
	});

	// manage consignaciones data table

	// manage ventas data table
	manageOrderTableConsig = $('#manageOrderTableConsig').DataTable({
		'ajax': 'php_action/pdv/fetchConsignaciones.php',
		'order': []
	});


});// document.ready fucntion

	function filtarVenta() {
		//alert("dd");
		var id = $('#selectid').val();
		console.log(id);
		window.location.href = "gestionPuntoDeVenta.php?user_id="+id;
	}

