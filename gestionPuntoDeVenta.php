<?php 
header('Content-Type: text/html; charset=UTF-8');
require_once 'config/db_connect.php'; 
require_once 'includes/header.php'; 
$valueUserId = "";
if (isset($_GET['user_id'])){
	$valueUserId = $_GET['user_id'];
}
?>

<input type="hidden" name="userIdFilter" id="userIdFilter" autocomplete="off" value="<?php echo $valueUserId;?>" />


<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Inicio</a></li>
		  <li>Ordenes</li>
		  <li class="active">
		  		Gestionar Ordenes
		  </li>
		</ol>

		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->
 
<div class="row">

	<ul class="nav nav-pills nav-justified" role="tablist">
	  <li class="active"><a href="#ventas" aria-controls="home" role="tab" data-toggle="tab">Ventas</a></li>
	  <li><a href="#consignaciones" aria-controls="home" role="tab" data-toggle="tab">Consignaciones</a></li>
	</ul>

	<div class="tab-content">

		<div role="tabpanel" class="tab-pane active" id="ventas">
			</br>
			</br>
			<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Listado de Ventas</div>
			</div> <!-- /panel-heading -->

				<div class="panel-body">

					<div class="remove-messages"></div>

					<div class="row" style="padding: 0px 15px;">
						<select class="col-md-3 mdl-textfield__input js-example-basic-single" id="selectid" name="selectid">
						  <option value="">Seleccione</option>
							<?php 
						  	$sql = "SELECT user_id, email FROM users";
									$result = $connect->query($sql);

									while($row = $result->fetch_array()) {
										if ($data[2] == $row[0]) {
											echo "<option value='".$row[0]."' selected>".$row[1]."</option>";
										} else {
											echo "<option value='".$row[0]."'>".$row[1]."</option>";
										}
									} // while
						  	?>
						</select>
						<button type="submit" onclick="filtarVenta()" id="editOrderBtn" data-loading-text="Cargando..." class="btn btn-default button1"><i class="glyphicon glyphicon-search"></i>Filtrar</button>	
					
					
					<div class="div-action pull pull-right" style="padding-bottom:20px;">
						<a href="puntoDeVenta.php"><button class="btn btn-default button1"> <i class="glyphicon glyphicon-plus-sign"></i> Agregar Orden </button></a>
					</div> <!-- /div-action -->	
					</div>
					<table class="table" id="manageOrderTableVentas">
						<thead>
							<tr>
								<th>Folio</th>
								<th>Fecha</th>
								<th>Cod Cte.</th>							
								<th>Nombre Cliente</th>
								<th>Total</th>
								<th>Monto(Abono)</th>
								<th>Saldo</th>		
								<th>Estatus</th>										
								<th style="width:15%;">Opciones</th>
							</tr>
						</thead>
					</table>
					<!-- /table -->

				</div> <!-- /panel-body -->
			</div> <!-- /panel -->	

		</div><!--End Tabpanel-ventas-->
<!--*******************************************************************************************************************************************************************************************-->
		<div role="tabpanel" class="tab-pane" id="consignaciones">
			</br>
			</br>
			<div class="panel panel-success">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Listado de Consignaciones</div>
			</div> <!-- /panel-heading -->

				<div class="panel-body">

					<div class="remove-messages"></div>

					<div class="div-action pull pull-right" style="padding-bottom:20px;">
						<a href="puntoDeVenta.php"><button class="btn btn-default button1"> <i class="glyphicon glyphicon-plus-sign"></i> Agregar Orden </button></a>
					</div> <!-- /div-action -->	

					<table class="table" id="manageOrderTableConsig">
						<thead>
							<tr>
								<th>Folio</th>
								<th>Fecha</th>
								<th>Cod Cte.</th>							
								<th>Nombre Cliente</th>
								<th>Total</th>
								<th>Monto(Abono)</th>
								<th>Saldo</th>		
								<th>Estatus</th>									
								<th style="width:15%;">Opciones</th>
							</tr>
						</thead>
					</table>
					<!-- /table -->

				</div> <!-- /panel-body -->
			</div> <!-- /panel -->	
			
		</div><!--End Tabpanel-consignaciones-->


	</div><!--End Tab-Content-->

</div><!--End row-->

<script src="custom/js/gestionPuntoDeVenta.js"></script>
<?php require_once 'includes/footer.php'; ?>


