<?php 	

require_once '../config/core.php';

$miStockId = $_POST['miStockId'];

$sql = "SELECT * FROM stock WHERE stock_id = $miStockId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);