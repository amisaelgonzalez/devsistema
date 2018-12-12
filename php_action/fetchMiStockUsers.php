<?php

require_once '../config/core.php';

$user_id = $_SESSION['userId'];

$sql = "SELECT s.stock_id, s.product_name, s.product_image, 
		s.quantity, s.rate, b.brand_name, c.categories_name 
 		FROM stock_users s
		INNER JOIN brands b ON s.brand_id = b.brand_id 
		INNER JOIN categories c ON s.categories_id = c.categories_id  
		WHERE s.status = 1 AND s.user_id = '$user_id'";

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 while($row = $result->fetch_array()) {
 	$miStockId = $row[0];

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Acción <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="descontarMiStockModalBtn" data-target="#descontarMiStockModal" onclick="descontarMiStock('.$miStockId.')"> <i class="glyphicon glyphicon-edit"></i> Descontar</a></li>
	    <li><a type="button" data-toggle="modal" id="editMiStockModalBtn" data-target="#editMiStockModal" onclick="editMiStock('.$miStockId.')"> <i class="glyphicon glyphicon-edit"></i> Editar</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeMiStockModal" id="removeMiStockModalBtn" onclick="removeMiStock('.$miStockId.')"> <i class="glyphicon glyphicon-trash"></i> Eliminar</a></li>       
	  </ul>
	</div>';

	$imageUrl = substr($row[2], 3);
	$miStockImage = "<img class='img-round' src='".$imageUrl."' style='height:30px; width:50px;'  />";

 	$output['data'][] = array( 		
 		// image
 		$miStockImage,
 		// miStock name
 		$row[1], 
 		// quantity
 		$row[4],
 		// price
 		$row[3], 		 	
 		// brand
 		$row[5],
 		// category 		
 		$row[6],
 		// button
 		//$button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);