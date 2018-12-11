<?php 	

require_once '../config/core.php';

$userId = $_SESSION['userId'];
$sucursales_id = $_SESSION['sucursales_id'];

$sql = "SELECT s.pedido_sucursal_id, s.pedido_sucursal_date, s.detalle, s.total FROM pedido_sucursal s WHERE s.pedido_sucursal_status = 1 AND user_id = '$userId' AND s.sucursales_id = '$sucursales_id'";
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
		<li><a href="pedidos_sucursal.php?o=detalle&i='.$pedidoSucursalId.'"> <i class="glyphicon glyphicon-eyes"></i> Ver pedido </a></li>
	    <li><a href="pedidos_sucursal.php?o=editOrd&i='.$pedidoSucursalId.'" id="editPedidoSucursalModalBtn"> <i class="glyphicon glyphicon-edit"></i> Editar</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removePedidoSucursalModal" id="removePedidoSucursalModalBtn" onclick="removePedidoSucursal('.$pedidoSucursalId.')"> <i class="glyphicon glyphicon-trash"></i> Eliminar</a></li>       
	  </ul>
	</div>';		

 	$output['data'][] = array( 		
 		// num pedidoSucursal
 		$row[0],
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