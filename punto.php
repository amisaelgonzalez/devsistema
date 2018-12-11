<?php 
require_once 'config/db_connect.php'; 
require_once 'includes/header.php'; 
include ("notification.php");
if ($_SESSION['rol'] == 1) {

if($_GET['o'] == 'add') { 
// add pedidoSucursal
	echo "<div class='div-request div-hide'>add</div>";
} else if($_GET['o'] == 'manord') { 
	echo "<div class='div-request div-hide'>manord</div>";
}else if($_GET['o'] == 'detalle') { 
	echo "<div class='div-request div-hide'>detalle</div>";
} else if($_GET['o'] == 'editOrd') { 
	echo "<div class='div-request div-hide'>editOrd</div>";
} // /else manage pedidoSucursal

?>

<ol class="breadcrumb">
  <li><a href="dashboard_sucursales.php">Inicio</a></li>
  <li>Ventas</li>
  <li class="active">
  	<?php if($_GET['o'] == 'add') { ?>
  		Agregar venta
		<?php } else if($_GET['o'] == 'manord') { ?>
			Sistema punto de venta
		<?php } else if($_GET['o'] == 'editOrd') { ?>
			Editar pedidos
		<?php } else if($_GET['o'] == 'detalle') { ?>
			Detalle
		<?php } ?>	
  </li>
</ol>


<h4>
	<i class='glyphicon glyphicon-circle-arrow-right'></i>
	<?php if($_GET['o'] == 'add') {
		echo "Agregar venta";
	} else if($_GET['o'] == 'manord') { 
		echo "Punto de venta";
	} else if($_GET['o'] == 'editOrd') { 
		echo "Editar venta";
	} else if($_GET['o'] == 'detalle') { 
		echo "Ver detalle de la venta";
	}
	?>	
</h4>



<div class="panel panel-default">
	<div class="panel-heading">

		<?php if($_GET['o'] == 'add') { ?>
  		<i class="glyphicon glyphicon-plus-sign"></i> Agregar venta
		<?php } else if($_GET['o'] == 'manord') { ?>
			<i class="glyphicon glyphicon-edit"></i> Listado de ventas
		<?php } else if($_GET['o'] == 'editOrd') { ?>
			<i class="glyphicon glyphicon-edit"></i> Editar venta
		<?php } else if($_GET['o'] == 'detalle') { ?>
			<i class="glyphicon glyphicon-edit"></i> Ver venta
		<?php } ?>

	</div> <!--/panel-->	
	<div class="panel-body">
			
		<?php if($_GET['o'] == 'add') { 
			// add pedidoSucursal
			?>			

			<div class="success-messages"></div> <!--/success-messages-->

  		<form class="form-horizontal" method="POST" action="php_action/createPedidoSucursal.php" id="createPedidoSucursalForm">

			  <!--<div class="form-group">
			    <label for="detalle" class="col-sm-2 control-label">Detalle </label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="detalle" name="detalle" autocomplete="off" />
			    </div>
			  </div>--> <!--/form-group-->  	  

			  <table class="table" id="productTable">
			  	<thead>
			  		<tr>			  			
			  			<th style="width:40%;">Producto</th>
			  			<th style="width:20%;">Precio</th>
			  			<th style="width:15%;">Cantidad</th>
			  			<th style="width:15%;">Total</th>			  			
			  			<th style="width:10%;"></th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php
			  		$arrayNumber = 0;
			  		for($x = 1; $x < 3; $x++) { ?>
			  			<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
			  				<td style="margin-left:20px;">
			  					<div class="form-group">

			  					<select class="form-control" name="productName[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" >
			  						<option value="">-- Selecciona --</option>
			  						<?php
			  							$productSql = "SELECT * FROM product WHERE active = 1 AND status = 1 AND quantity != 0";
			  							$productData = $connect->query($productSql);

			  							while($row = $productData->fetch_array()) {									 		
			  								echo "<option value='".$row['product_id']."' id='changeProduct".$row['product_id']."'>".$row['product_name']."</option>";
										 	} // /while 

			  						?>
		  						</select>
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="rate[]" id="rate<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" />			  					
			  					<input type="hidden" name="rateValue[]" id="rateValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
			  				</td>
			  				<td style="padding-left:20px;">
			  					<div class="form-group">
			  					<input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" />
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" />			  					
			  					<input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
			  				</td>
			  				<td>

			  					<button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
			  				</td>
			  			</tr>
		  			<?php
		  			$arrayNumber++;
			  		} // /for
			  		?>
			  	</tbody>			  	
			  </table>

			  <div class="col-md-12">
			  	<div class="form-group">
				    <label for="subTotal" class="col-sm-3 control-label">Sub total</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" />
				      <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" />
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="form-group">
				    <label for="vat" class="col-sm-3 control-label">IVA 13%</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="vat" name="vat" disabled="true" />
				      <input type="hidden" class="form-control" id="vatValue" name="vatValue" />
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="form-group">
				    <label for="totalAmount" class="col-sm-3 control-label">Total neto</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true"/>
				      <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" />
				    </div>
				  </div> <!--/form-group-->	  		  
			  </div> <!--/col-md-6-->


			  <div class="form-group submitButtonFooter">
			    <div class="col-sm-offset-2 col-sm-10">
			    <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Cargando..."> <i class="glyphicon glyphicon-plus-sign"></i> Añadir fila </button>

			      <button type="submit" id="createPedidoSucursalBtn" data-loading-text="Cargando..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>

			      <button type="reset" class="btn btn-default" onclick="resetPedidoSucursalForm()"><i class="glyphicon glyphicon-erase"></i> Reiniciar</button>
			    </div>
			  </div>
			</form>
		<?php } else if($_GET['o'] == 'manord') { 
			// manage pedidoSucursal
			?>

			<div id="success-messages"></div>
			
			<table class="table" id="managePedidoSucursalTable">
				<thead>
					<tr>
						<th>Número de Venta</th>
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
		} else if($_GET['o'] == 'editOrd') {
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


			  <div class="form-group">
			    <label for="detalle" class="col-sm-2 control-label">Detalle </label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="detalle" name="detalle" autocomplete="off" value="<?php echo $data[1] ?>" />
			    </div>
			  </div> <!--/form-group-->	  

			  <table class="table" id="productTable">
			  	<thead>
			  		<tr>			  			
			  			<th style="width:40%;">Producto</th>
			  			<th style="width:20%;">Precio</th>
			  			<th style="width:15%;">Cantidad</th>
			  			<th style="width:15%;">Total</th>			  			
			  			<th style="width:10%;"></th>
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
			  					<div class="form-group">

			  					<select class="form-control" name="productName[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" >
			  						<option value="">-- Selecciona --</option>
			  						<?php
			  							$productSql = "SELECT * FROM product WHERE active = 1 AND status = 1 AND quantity != 0";
			  							$productData = $connect->query($productSql);

			  							while($row = $productData->fetch_array()) {									 		
			  								$selected = "";
			  								if($row['product_id'] == $pedidoSucursalItemData['product_id']) {
			  									$selected = "selected";
			  								} else {
			  									$selected = "";
			  								}

			  								echo "<option value='".$row['product_id']."' id='changeProduct".$row['product_id']."' ".$selected." >".$row['product_name']."</option>";
										 	} // /while 

			  						?>
		  						</select>
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="rate[]" id="rate<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" value="<?php echo $pedidoSucursalItemData['rate']; ?>" />			  					
			  					<input type="hidden" name="rateValue[]" id="rateValue<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $pedidoSucursalItemData['rate']; ?>" />			  					
			  				</td>
			  				<td style="padding-left:20px;">
			  					<div class="form-group">
			  					<input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" value="<?php echo $pedidoSucursalItemData['quantity']; ?>" />
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" value="<?php echo $pedidoSucursalItemData['total']; ?>"/>			  					
			  					<input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $pedidoSucursalItemData['total']; ?>"/>			  					
			  				</td>
			  				<td>

			  					<button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
			  				</td>
			  			</tr>
		  			<?php
		  			$arrayNumber++;
		  			$x++;
			  		} // /for
			  		?>
			  	</tbody>			  	
			  </table>

			  <div class="col-md-6">
			  	<div class="form-group">
				    <label for="subTotal" class="col-sm-3 control-label">Sub total</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" value="<?php echo $data[2] ?>" />
				      <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" value="<?php echo $data[2] ?>" />
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="form-group">
				    <label for="vat" class="col-sm-3 control-label">IVA 13%</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="vat" name="vat" disabled="true" value="<?php echo $data[3] ?>"  />
				      <input type="hidden" class="form-control" id="vatValue" name="vatValue" value="<?php echo $data[3] ?>"  />
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="form-group">
				    <label for="totalAmount" class="col-sm-3 control-label">Total neto</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true" value="<?php echo $data[4] ?>" />
				      <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" value="<?php echo $data[4] ?>"  />
				      <input type="hidden" class="form-control" id="totalAmountValueAct" name="totalAmountValueAct" value="<?php echo $data[4] ?>"  />
				    </div>
				  </div> <!--/form-group-->		  		  
			  </div> <!--/col-md-6-->

			  <div class="form-group editButtonFooter">
			    <div class="col-sm-offset-2 col-sm-10">
			    <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="cargando..."> <i class="glyphicon glyphicon-plus-sign"></i> Añadir fila </button>

			    <input type="hidden" name="pedidoSucursalId" id="pedidoSucursalId" value="<?php echo $_GET['i']; ?>" />

			    <button type="submit" id="editPedidoSucursalBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
			      
			    </div>
			  </div>
			</form>

		<?php
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
		  						</select>
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">

								<?php echo $pedidoSucursalItemData['rate']; ?>

			  				</td>
			  				<td style="padding-left:20px;">
								
								<?php echo $pedidoSucursalItemData['quantity']; ?>

			  				</td>
			  				<td style="padding-left:20px;">

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

<!-- remove pedidoSucursal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removePedidoSucursalModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Eliminar venta</h4>
      </div>
      <div class="modal-body">

      	<div class="removePedidoSucursalMessages"></div>

        <p>Realmente deseas eliminar este registro?</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
        <button type="button" class="btn btn-primary" id="removePedidoSucursalBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove pedidoSucursal-->


<script src="custom/js/pedidoSucursal.js"></script>

<?php require_once 'includes/footer.php'; ?>
<?php }else{ echo "<script> alert('Su usuario no posee los permisos para entrar en esta vista, usted sera redireccionado.'); window.location.href = 'index.php' </script>";} ?>