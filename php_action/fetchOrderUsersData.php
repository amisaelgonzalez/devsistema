<?php 	

require_once '../config/core.php';

$orderId = $_POST['orderId'];

$valid = array('order' => array(), 'order_item' => array());

$sql = "SELECT orders_user.order_id, orders_user.order_date, orders_user.client_name, orders_user.client_contact, orders_user.sub_total, orders_user.vat, orders_user.total_amount, orders_user.discount, orders_user.grand_total, orders_user.paid, orders_user.due, orders_user.payment_type, orders_user.payment_status FROM orders_user 	
	WHERE orders_user.order_id = {$orderId}";

$result = $connect->query($sql);
$data = $result->fetch_row();
$valid['order'] = $data;


$connect->close();

echo json_encode($valid);