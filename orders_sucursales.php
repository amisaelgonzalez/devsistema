<?php 
require_once 'config/db_connect.php'; 
require_once 'includes/header.php'; 
include ("notification.php");
if ($_SESSION['rol'] == 2 && $_GET['id']) {
?>

<div class='div-request div-hide'>editOrd</div>

<ol class="breadcrumb">
  <li><a href="dashboard_sucursales.php">Inicio</a></li>
  <li>Cr&eacute;ditos</li>
  <li class="active">Ver cr&eacute;ditos</li>
</ol>


<h4>
	<i class='glyphicon glyphicon-circle-arrow-right'></i>
	<?php echo "Créditos id: ".$_GET['id'];?>	
</h4>


<div class="panel panel-default">
	<div class="panel-heading">

		<i class="glyphicon glyphicon-edit"></i> Ver Cr&eacute;dito

	</div> <!--/panel-->	
	<div class="panel-body">
			
		<div class="success-messages"></div> <!--/success-messages-->

  		<form class="form-horizontal" method="POST" action="php_action/editOrder.php" id="editOrderForm">

  			<?php $orderId = $_GET['id'];

  			$sql = "SELECT orders.order_id, orders.order_date, orders.client_name, orders.client_contact, orders.sub_total, orders.vat, orders.total_amount, orders.discount, orders.grand_total, orders.paid, orders.due, orders.payment_type, orders.payment_status FROM orders 	
					WHERE orders.order_id = {$orderId}";

				$result = $connect->query($sql);
				$data = $result->fetch_row();				
  			?>

			  <div style="margin: 10px">
			    <strong>Fecha: </strong><?php echo $data[1] ?>
			  </div>  

			  <table class="table" id="productTable">
			  	<thead>
			  		<tr>			  			
			  			<th style="width:40%;">Producto</th>
			  			<th style="width:20%;">Precio</th>
			  			<th style="width:15%;">Cantidad</th>
			  			<th style="width:15%;">Total</th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php

			  		$orderItemSql = "SELECT order_item.order_item_id, order_item.order_id, order_item.product_id, order_item.quantity, order_item.rate, order_item.total FROM order_item WHERE order_item.order_id = {$orderId}";
						$orderItemResult = $connect->query($orderItemSql);
						// $orderItemData = $orderItemResult->fetch_all();						
						
						// print_r($orderItemData);
			  		$arrayNumber = 0;
			  		// for($x = 1; $x <= count($orderItemData); $x++) {
			  		$x = 1;
			  		while($orderItemData = $orderItemResult->fetch_array()) { 
			  			// print_r($orderItemData); ?>
			  			<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
			  				<td>
		  						<?php
		  							$productSql = "SELECT * FROM product WHERE product_id = ".$orderItemData['product_id'];
		  							$productData = $connect->query($productSql);

		  							while($row = $productData->fetch_array()) {

		  								echo $row['product_name'];
								 	} // /while 

		  						?>
			  				</td>
			  				<td>

			  					<?php echo $orderItemData['rate']; ?>

			  				</td>
			  				<td>

			  					<?php echo $orderItemData['quantity']; ?>

			  				</td>
			  				<td>			  					
			  					
			  					<?php echo $orderItemData['total']; ?>

			  				</td>
			  			</tr>
		  			<?php
		  			$arrayNumber++;
		  			$x++;
			  		} // /for
			  		?>
			  	</tbody>			  	
			  </table>

			  <div style="margin: 10px">
			    <strong>Sub total: </strong><?php echo $data[4] ?>
			    <br>
			    <strong>IVA 13%: </strong><?php echo $data[5] ?>
			    <br>
			    <strong>Total neto: </strong><?php echo $data[6] ?>
			  </div>

			</form>

	</div> <!--/panel-->	
</div> <!--/panel-->	

<?php require_once 'includes/footer.php'; ?>
<?php }else{ echo "<script> alert('Su usuario no posee los permisos para entrar en esta vista, usted sera redireccionado.'); window.location.href = 'index.php' </script>";} ?>