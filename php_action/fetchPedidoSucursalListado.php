<?php 	

require_once '../config/core.php';

$sql = "SELECT s.pedido_sucursal_id, s.pedido_sucursal_date, s.detalle, s.total, su.sucursales_name FROM pedido_sucursal s INNER JOIN sucursales su ON s.sucursales_id = su.sucursales_id WHERE s.pedido_sucursal_status = 1";

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 
 
 while($row = $result->fetch_array()) {
 	$pedidoSucursalId = $row[0];

 	$countPedidoSucursalItemSql = "SELECT count(*) FROM pedido_producto_sucursal WHERE pedido_sucursal_id = $pedidoSucursalId";
 	$itemCountResult = $connect->query($countPedidoSucursalItemSql);
 	$itemCountRow = $itemCountResult->fetch_row();


 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Acción <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a href="pedidos_sucursal_listado.php?o=detalle&i='.$pedidoSucursalId.'" id="detallePedidoSucursalModalBtn"> <i class="glyphicon glyphicon-edit"></i> Ver productos </a></li>
	</div>';		

 	$output['data'][] = array( 		
 		// num pedidoSucursal
 		$row[0],
 		// sucursal name
 		$row[4],
 		// pedidoSucursal date
 		$row[1],
 		// detalle
 		$row[2],
 		// cantidad
 		$itemCountRow,
 		// total
 		$row[3],
 		// button
 		$button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);