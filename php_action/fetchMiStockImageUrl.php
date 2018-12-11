<?php 	

require_once '../config/core.php';

$miStockId = $_GET['i'];

$sql = "SELECT product_image FROM stock WHERE stock_id = {$miStockId}";
$data = $connect->query($sql);
$result = $data->fetch_row();

$connect->close();

echo "stock/" . $result[0];
