<?php

require_once '../config/core.php';
$add_query = "";
if ($_SESSION['rol'] != 1) {
	$add_query = " AND product.active = 1";
}
$sql = "SELECT product.product_id, product.product_name, product.product_image, product.brand_id,
 		product.categories_id, product.quantity, product.price_mayoreo, product.rate, 
 		product.active, product.status, brands.brand_name, categories.categories_name 
 		FROM product 
		INNER JOIN brands ON product.brand_id = brands.brand_id 
		INNER JOIN categories ON product.categories_id = categories.categories_id  
		WHERE product.status = 1 ".$add_query;

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $active = ""; 

 while($row = $result->fetch_array()) {
 	$productId = $row[0];
 	// active 
 	if($row[8] == 1) {
 		// activate member
 		$active = "<label class='label label-success'>Disponible</label>";
 	} else {
 		// deactivate member
 		$active = "<label class='label label-danger'>No disponible</label>";
 	} // /else

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Acción <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="editStockGeneralModalBtn" data-target="#editStockGeneralModal" onclick="editStockGeneral('.$productId.')"> <i class="glyphicon glyphicon-plus"></i> Agregar a mi stock</a></li>    
	  </ul>
	</div>';

	// $brandId = $row[3];
	// $brandSql = "SELECT * FROM brands WHERE brand_id = $brandId";
	// $brandData = $connect->query($sql);
	// $brand = "";
	// while($row = $brandData->fetch_assoc()) {
	// 	$brand = $row['brand_name'];
	// }

	$brand = $row[10];
	$category = $row[11];

	$imageUrl = substr($row[2], 3);
	$productImage = "<img class='img-round' src='".$imageUrl."' style='height:30px; width:50px;'  />";

 	$output['data'][] = array( 		
 		// image
 		$productImage,
 		// product name
 		$row[1], 
 		// price mayoreo
 		$row[6],
 		// quantity 
 		$row[5], 		 	
 		// brand
 		$brand,
 		// category 		
 		$category,
 		// active
 		$active,
 		// button
 		//$button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);