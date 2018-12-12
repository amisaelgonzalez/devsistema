<?php

require_once '../config/core.php';

$SucursalId = $_SESSION['sucursales_id'];

$sql = "SELECT s.stock_id, s.product_name, s.product_image, 
		s.quantity, s.rate, b.brand_name, c.categories_name 
 		FROM stock s
		INNER JOIN brands b ON s.brand_id = b.brand_id 
		INNER JOIN categories c ON s.categories_id = c.categories_id  
		WHERE s.status = 1 AND s.sucursales_id = '$SucursalId'";

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $active = ""; 

 while($row = $result->fetch_array()) {
 	$stockId = $row[0];
 	// active 
/* 	if($row[8] == 1) {
 		// activate member
 		$active = "<label class='label label-success'>Disponible</label>";
 	} else {
 		// deactivate member
 		$active = "<label class='label label-danger'>No disponible</label>";
 	} // /else
*/
 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Acción <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="descontarMiStockModalBtn" data-target="#descontarMiStockModal" onclick="descontarMiStock('.$stockId.')"> <i class="glyphicon glyphicon-edit"></i>Agregar a mi stock</a></li>      
	  </ul>
	</div>';

	$brand = $row[5];
	$category = $row[6];

	$imageUrl = substr($row[2], 3);
	$productImage = "<img class='img-round' src='".$imageUrl."' style='height:30px; width:50px;'  />";

 	$output['data'][] = array( 		
 		// image
 		$productImage,
 		// product name
 		$row[1], 
 		// price mayoreo
 		$row[4],
 		// quantity 
 		$row[3], 		 	
 		// brand
 		$brand,
 		// category 		
 		$category,
 		// active
 		//$active,
 		// button
 		$button 		
 		); 	
 } // /while 


}// if num_rows

$connect->close();

echo json_encode($output);