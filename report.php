<?php require_once 'includes/header.php'; ?>
<?php include ("notification.php"); ?>  
<?php if ($_SESSION['rol'] == 1  || $_SESSION['rol'] == 4) { ?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Reportes por fechas
			</div>
			<!-- /panel-heading -->
			<div class="panel-body">
				
				<form class="form-horizontal" action="php_action/getOrderReport.php" method="post" id="getOrderReportForm">
				  <div class="form-group">
				    <label for="startDate" class="col-sm-2 control-label">Fecha inicial</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="startDate" name="startDate" placeholder="Fecha inicial" />
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="endDate" class="col-sm-2 control-label">Fecha final</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="endDate" name="endDate" placeholder="Fecha final" />
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" class="btn btn-success" id="generateReportBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Generar Reporte</button>
				    </div>
				  </div>
				</form>

			</div><!-- /panel-body -->
		</div>
	</div><!-- /col-dm-12 -->

	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				 Reportes por sucursal
			</div>
			<!-- /panel-heading -->
			<div class="panel-body">
				
				<form class="form-horizontal" action="php_action/getOrderPorSucursalesReport.php" method="post" id="getOrderPorSucursalesReportForm">

				  <div class="form-group">
		        	<label for="sucursalId" class="col-sm-2 control-label">Sucursal: </label>
					    <div class="col-sm-10">
					      <select class="form-control" id="sucursalId" name="sucursalId">
					      	<option value="">-- Seleciona--</option>
					      	<?php 
					      	$sql = "SELECT sucursales_id, sucursales_name FROM sucursales WHERE sucursales_status = 1";
									$result = $connect->query($sql);

									while($row = $result->fetch_array()) {
										echo "<option value='".$row[0]."'>".$row[1]."</option>";
									} // while
									
					      	?>
					      </select>
					    </div>
		          </div> <!-- /form-group-->

				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" class="btn btn-success" id="generateReportSucBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Generar Reporte</button>
				    </div>
				  </div>
				</form>

			</div><!-- /panel-body -->
		</div>
	</div><!-- /col-dm-12 -->

</div><!-- /row -->

<script src="custom/js/report.js"></script>
<?php require_once 'includes/footer.php'; ?>
<?php }else{ echo "<script> alert('Su usuario no posee los permisos para entrar en esta vista, usted sera redireccionado.'); window.location.href = 'index.php' </script>";} ?>