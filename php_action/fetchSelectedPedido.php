<?php

require_once '../config/core.php';

$pedidoId = $_POST['pedidoId'];

$sql = "SELECT pedido_id, brand_id, pedido_name FROM pedidos WHERE pedido_id = $pedidoId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);