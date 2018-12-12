<?php 	

require_once '../config/core.php';

$orderId = $_POST['orderId'];

$sql = "SELECT o.order_date, s.sucursales_name, o.client_contact, o.sub_total, o.vat, o.total_amount, o.discount, o.grand_total, o.paid, o.due, o.fecha_add, o.hora_add FROM orders o INNER JOIN sucursales s ON s.sucursales_id = o.client_name WHERE o.order_id = $orderId";

$orderResult = $connect->query($sql);
$orderData = $orderResult->fetch_array();

$orderDate = $orderData[0];
$clientName = $orderData[1];
$clientContact = $orderData[2]; 
$subTotal = $orderData[3];
$vat = $orderData[4];
$totalAmount = $orderData[5]; 
$discount = $orderData[6];
$grandTotal = $orderData[7];
$paid = $orderData[8];
$due = $orderData[9];
$fecha_add = $orderData[10];


$orderItemSql = "SELECT order_item.product_id, order_item.rate, order_item.quantity, order_item.total,
product.product_name FROM order_item
	INNER JOIN product ON order_item.product_id = product.product_id 
 WHERE order_item.order_id = $orderId";
$orderItemResult = $connect->query($orderItemSql);

 $table = '
 <table border="1" cellspacing="0" cellpadding="20" width="100%">
	<thead>
		<tr >
			<th colspan="5">

			<center>
				Fecha del registro: '.$fecha_add.'<br>
				Fecha de la orden: '.$orderDate.'
				<center>Cliente : '.$clientName.'</center>
				Teléfono : '.$clientContact.'
			</center>		
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