<?php

require_once '../config/core.php';

$sql = "SELECT s.solicitudes_id, st.product_name, st.product_image, su.sucursales_name, s.solicitudes_status, s.cantidad
 		FROM solicitudes s 
		INNER JOIN stock st ON st.stock_id = s.stock_id 
		INNER JOIN sucursales su ON su.sucursales_id = s.sucursal_solicitud_id  
		WHERE s.sucursal_pedido_id = ".$_SESSION['sucursales_id'];

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $active = ""; 
 $button = "";

 while($row = $result->fetch_array()) {
 	$solicitudesId = $row[0];
 	// active 
 	if($row[4] == 3) {
 		$active = "<label class='label label-success'>Aprobada</label>";
 	} elseif ($row[4] == 2) {
 		$active = "<label class='label label-danger'>Cancelado</label>";
 	} else {
 		$active = "<label class='label label-info'>Pendiente</label>";
 	
	 	$button = '<!-- Single button -->
		<div class="btn-group">
		  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    Acción <span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu">
		    <li><a type="button" data-toggle="modal" id="traspasarModalBtn" data-target="#traspasarModal" onclick="editSolicitudes('.$solicitudesId.')"> <i class="glyphicon glyphicon-ok"></i> Aprobar traspaso</a></li>
		    <li><a type="button" data-toggle="modal" data-target="#removeTraspasoModal" id="removeTraspasoModalBtn" onclick="removeTraspaso('.$solicitudesId.')"> <i class="glyphicon glyphicon-remove"></i> Negar traspaso</a></li>  
		  </ul>
		</div>';
	}

	$imageUrl = substr($row[2], 3);
	$productImage = "<img class='img-round' src='".$imageUrl."' style='height:30px; width:50px;'  />";

 	$output['data'][] = array( 		
 		// image
 		$productImage,
 		// product name
 		$row[1], 
 		//cantidad
 		$row[5],
 		// solicitante
 		$row[3],
 		// status
 		$active,
 		// button
 		//$button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);