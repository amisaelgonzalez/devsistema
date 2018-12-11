var manageStockTable;

$(document).ready(function() {
	// top nav bar 
	$('#navProduct').addClass('active');
	// manage tock data table
	manageStockTable = $('#manageStockTable').DataTable({
		'ajax': 'php_action/fetchStock.php',
		'order': []
	});

}); // document.ready fucntion
