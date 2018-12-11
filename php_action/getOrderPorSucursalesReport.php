<?php 

require_once '../config/core.php';

if($_POST) {

	$sucursalId = $_POST['sucursalId'];

	$sql = "SELECT o.order_date, s.sucursales_name, o.client_contact, o.grand_total FROM orders o INNER JOIN sucursales s ON s.sucursales_id = o.client_name WHERE client_name = '$sucursalId' AND order_status = 1";
	$query = $connect->query($sql);

	$table = '
	<table border="1" cellspacing="0" cellpadding="0" style="width:100%;">
		<tr>
			<th>Fecha</th>
			<th>Sucursal</th>
			<th>Teléfono</th>
			<th>Total</th>
		</tr>

		<tr>';
		$totalAmount = "";
		while ($result = $query->fetch_assoc()) {
			$table .= '<tr>
				<td><center>'.$result['order_date'].'</center></td>
				<td><center>'.$result['sucursales_name'].'</center></td>
				<td><center>'.$result['client_contact'].'</center></td>
				<td><center>'.$result['grand_total'].'</center></td>
			</tr>';	
			$totalAmount += $result['grand_total'];
		}
		$table .= '
		</tr>

		<tr>
			<td colspan="3"><center>Total</center></td>
			<td><center>'.$totalAmount.'</center></td>
		</tr>
	</table>
	';	

	echo $table;

}

?>