<?php 
require_once 'config/db_connect.php'; 
require_once 'includes/header.php'; 
include ("notification.php");
if ($_SESSION['rol'] == 1) {

if($_GET['o'] == 'manord') { 
	echo "<div class='div-request div-hide'>manord</div>";
} else if($_GET['o'] == 'detalle') { 
	echo "<div class='div-request div-hide'>detalle</div>";
} // /else manage pedidoSucursal

?>

<ol class="breadcrumb">
  <li><a href="dashboard.php">Inicio</a></li>
  <li>Pedido</li>
  <li class="active">Listado de pedidos</li>
</ol>


<h4>
	<i class='glyphicon glyphicon-circle-arrow-right'></i>
	<?php if($_GET['o'] == 'manord') { 
		echo "Listado de pedidos";
	} else if($_GET['o'] == 'detalle') { 
		echo "Detalle";
	}
	?>	
</h4>



<div class="panel panel-default">
	<div class="panel-heading">

		<?php if($_GET['o'] == 'manord') { ?>
			 Listado de pedidos
		<?php } else if($_GET['o'] == 'detalle') { ?>
			<i class="glyphicon glyphicon-edit"></i> Detalle
		<?php } ?>

	</div> <!--/panel-->	
	<div class="panel-body">
			
		<?php if($_GET['o'] == 'manord') { 
			// manage pedidoSucursal
			?>

			<div id="success-messages"></div>
			
			<table class="table" id="managePedidoSucursalTable">
				<thead>
					<tr>
						<th>Número de pedido</th>
						<th>Sucursal</th>
						<th>Fecha</th>
						<th>Detalle</th>
						<th>Cantidad</th>
						<th>Total</th>
						<th>Opciones</th>
					</tr>
				</thead>
			</table>

		<?php 
		// /else manage pedidoSucursal
		} else if($_GET['o'] == 'detalle') {
			// get pedidoSucursal
			?>
			<div class="success-messages"></div> <!--/success-messages-->

  		<form class="form-horizontal" method="POST" action="php_action/editPedidoSucursal.php" id="editPedidoSucursalForm">

  			<?php $pedidoSucursalId = $_GET['i'];

  			$sql = "SELECT s.pedido_sucursal_id, s.detalle, s.sub_total, s.vat, s.total, s.pedido_sucursal_status FROM pedido_sucursal s	
					WHERE s.pedido_sucursal_id = {$pedidoSucursalId}";

				$result = $connect->query($sql);
				$data = $result->fetch_row();				
  			?>


			  <div style="margin: 10px">
			    <strong>Detalle: </strong><?php echo $data[1] ?>
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

			  		$pedidoSucursalItemSql = "SELECT p.pedido_producto_sucursal_id, p.pedido_sucursal_id, p.product_id, p.quantity, p.rate, p.total FROM pedido_producto_sucursal p WHERE p.pedido_sucursal_id = {$pedidoSucursalId}";
						$pedidoSucursalItemResult = $connect->query($pedidoSucursalItemSql);
						// $pedidoSucursalItemData = $pedidoSucursalItemResult->fetch_all();						
						
						// print_r($pedidoSucursalItemData);
			  		$arrayNumber = 0;
			  		// for($x = 1; $x <= count($pedidoSucursalItemData); $x++) {
			  		$x = 1;
			  		while($pedidoSucursalItemData = $pedidoSucursalItemResult->fetch_array()) { 
			  			// print_r($pedidoSucursalItemData); ?>
			  			<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
			  				<td style="margin-left:20px;">

		  						<?php
		  							$productSql = "SELECT product_name FROM product WHERE product_id = ".$pedidoSucursalItemData['product_id'];
		  							$productData = $connect->query($productSql);

		  							while($row = $productData->fetch_array()) {

		  								echo $row['product_name'];
									} // /while 
		  						?>
			  				</td>
			  				<td>			  					
			  					<?php echo $pedidoSucursalItemData['rate']; ?>	  					
			  				</td>
			  				<td>

		  						<?php echo $pedidoSucursalItemData['quantity']; ?>

			  				</td>
			  				<td>		
			  					
			  					<?php echo $pedidoSucursalItemData['total']; ?>	  					
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
			    <strong>Sub total: </strong><?php echo $data[2] ?>
			    <br>
			    <strong>IVA 13%: </strong><?php echo $data[3] ?>
			    <br>
			    <strong>Total neto: </strong><?php echo $data[4] ?>
			  </div>
			  
			</form>

			<?php
		} // /get pedidoSucursal else  ?>


	</div> <!--/panel-->	
</div> <!--/panel-->	

<script src="custom/js/pedidoSucursalListado.js"></script>
<?php require_once 'includes/footer.php'; ?>
<?php }else{ echo "<script> alert('Su usuario no posee los permisos para entrar en esta vista, usted sera redireccionado.'); window.location.href = 'index.php' </script>";} ?>