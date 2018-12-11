<?php 	

require_once '../../config/core.php';

$productId = $_POST['productId'];

$sql = "SELECT * FROM product_pdv WHERE  id_product= $productId";
$result = $connect->query($sql);




if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);