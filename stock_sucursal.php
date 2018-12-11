<?php require_once 'config/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>
<?php require_once 'modal/stockPorSucursalModal.php'; ?>
<?php include ("notification.php"); ?>
<?php if ($_SESSION['rol'] == 2) { ?>

<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard_sucursales.php">Inicio</a></li>		  
		  <li class="active">Stock por sucursal</li>
		</ol>

        <div class="col-xs-12" style="padding-left: 0px !important;padding-right: 0px !important;">
        	<label for="sucursal" class="col-xs-12 col-sm-4" style="padding-left: 0px !important;padding-right: 0px !important;">Seleccione una sucursal: </label>
			    <div class="col-xs-12 col-sm-8" style="padding-left: 0px !important;padding-right: 0px !important;">
			      <select class="form-control" id="sucursal" name="sucursal" onchange="buscarScursal();">
			      	<?php 
			      	$sql = "SELECT sucursales_id, sucursales_name FROM sucursales WHERE sucursales_status = 1";
							$result = $connect->query($sql);
							$i = 0;
							while($row = $result->fetch_array()) {
								if ($i == 0) {
									echo "<option value='".$row[0]."' selected>".$row[1]."</option>";
								}else{
									echo "<option value='".$row[0]."'>".$row[1]."</option>";
								}
								$i++;
							} // while
							
			      	?>
			      </select>
			    </div>
        </div> <!-- /form-group-->
        <br><br><br>


		<div class="panel panel-default col-xs-12" style="padding-left: 0px !important;padding-right: 0px !important;">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Listado de productos</div>
			</div> <!-- /panel-heading -->

			<div class="panel-body">

				<div class="remove-messages"></div>		
				
				<table class="table" id="manageStockPorSucursalTable">
					<thead>
						<tr>
							<th style="width:10%;">Imagen</th>							
							<th>Nombre del producto</th>
							<th>Precio de mayoreo</th>
							<th>Stock</th>
							<th>Fabricante</th>
							<th>Categoría</th>
							<!--<th>Estado</th>-->
							<th style="width:15%;">Opciones</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->


<script src="custom/js/stockPorSucursal.js"></script>
<?php require_once 'includes/footer.php'; ?>
<?php }else{ echo "<script> alert('Su usuario no posee los permisos para entrar en esta vista, usted sera redireccionado.'); window.location.href = 'index.php' </script>";} ?>