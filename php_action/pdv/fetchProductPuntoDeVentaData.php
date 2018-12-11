<?php 	

require_once '../../config/core.php';

$sql = "SELECT *  FROM product_pdv ";
$result = $connect->query($sql);

$data = $result->fetch_all();

$connect->close();

echo json_encode($data);