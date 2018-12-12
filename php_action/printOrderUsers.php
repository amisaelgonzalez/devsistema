<?php 	

require_once '../config/core.php';

$orderId = $_POST['orderId'];

$sql = "SELECT order_date, client_name, client_contact, sub_total, vat, total_amount, discount, grand_total, paid, due, calle, colina, ciudad, fecha_add, hora_add FROM orders_user WHERE order_id = $orderId";

$orderResult = $connect->query($sql);
$orderData = $orderResult->fetch_array();

$orderDate = $orderData[0];
$clientName = $orderData[1];
$clientContact = $orderData[2]; 

$calle = $orderData[10]; 
$colina = $orderData[11]; 
$ciudad = $orderData[12]; 

$subTotal = $orderData[3];
$vat = $orderData[4];
$totalAmount = $orderData[5]; 
$discount = $orderData[6];
$grandTotal = $orderData[7];
$paid = $orderData[8];
$due = $orderData[9];
$fecha_add = $orderData[13];

$orderItemSql = "SELECT order_user_item.product_id, order_user_item.rate, order_user_item.quantity, order_user_item.total,
product.product_name FROM order_user_item
	INNER JOIN product ON order_user_item.product_id = product.product_id 
 WHERE order_user_item.order_id = $orderId";
$orderItemResult = $connect->query($orderItemSql);

 $table = '
 <table border="1" cellspacing="0" cellpadding="20" width="100%">
	<thead>
		<tr >
			<th colspan="5">
				<center>Fecha  del registro : '.$fecha_add.'</center>
				<center>Fecha de la orden : '.$orderDate.'</center>
				<center>Nombre completo : '.$clientName.'</center>
				<center>Teléfono : '.$clientContact.'</center>
				<center>Calle : '.$calle.'</center>
				<center>Colina : '.$colina.'</center>
				<center>Ciudad : '.$ciudad.'</center>
			</th>
		</tr>		
	</thead>
</table>
<table border="0" width="100%;" cellpadding="5" style="border:1px solid black;border-top-style:1px solid black;border-bottom-style:1px solid black;">

	<tbody>
		<tr>
			<th>#</th>
			<th>Producto</th>
			<th>Precio</th>
			<th>Cantidad</th>
			<th>Total</th>
		</tr>';

		$x = 1;
		while($row = $orderItemResult->fetch_array()) {			
						
			$table .= '<tr>
				<th>'.$x.'</th>
				<th>'.$row[4].'</th>
				<th>'.$row[1].'</th>
				<th>'.$row[2].'</th>
				<th>'.number_format($row[3],2).'</th>
			</tr>
			';
		$x++;
		} // /while

		$table .= '<tr>
			<th></th>
		</tr>

		<tr>
			<th></th>
		</tr>

		<tr>
			<th>Sub total</th>
			<th>'.number_format($subTotal,2).'</th>			
		</tr>

		<tr>
			<th>IVA (13%)</th>
			<th>'.number_format($vat,2).'</th>			
		</tr>

		<tr>
			<th>Total neto</th>
			<th>'.number_format($totalAmount,2).'</th>			
		</tr>	

		<tr>
			<th>Descuento</th>
			<th>'.number_format($discount,2).'</th>			
		</tr>

		<tr>
			<th>Total</th>
			<th>'.number_format($grandTotal,2).'</th>			
		</tr>

		<tr>
			<th>Pagado</th>
			<th>'.number_format($paid,2).'</th>			
		</tr>

		<tr>
			<th>Pendiente</th>
			<th>'.number_format($due,2).'</th>			
		</tr>
	</tbody>
</table>
 ';


$connect->close();

echo $table;