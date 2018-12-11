<?php 	

require_once '../config/core.php';

$sql = "SELECT p.pedido_id, p.pedido_name, p.brand_id, b.brand_name FROM pedidos p INNER JOIN brands b ON p.brand_id = b.brand_id WHERE pedido_status = 1";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

// $row = $result->fetch_array();

 while($row = $result->fetch_array()) {
 	$pedidoId = $row[0];

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Acción <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editPedidoModel" onclick="editPedido('.$pedidoId.')"> <i class="glyphicon glyphicon-edit"></i> Editar</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removePedido('.$pedidoId.')"> <i class="glyphicon glyphicon-trash"></i> Eliminar</a></li>       
	  </ul>
	</div>';

 	$output['data'][] = array( 		
 		$row[3],
 		$row[1],
 		$button
 		); 	
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);