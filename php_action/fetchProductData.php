<?php 	

require_once '../config/core.php';

$sql = "SELECT product_id, product_name FROM product WHERE status = 1 AND active = 1";
$result = $connect->query($sql);

//$data = $result->fetch_all();
$data = array();
while ($row = $result->fetch_array()) {
    $data[] = array($row[0],$row[1]);
}

$connect->close();

echo json_encode($data);