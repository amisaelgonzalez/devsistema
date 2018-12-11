<?php require_once 'config/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>
<?php require_once 'modal/misSolicitudesModal.php'; ?>
<?php include ("notification.php"); ?>
<?php if ($_SESSION['rol'] == 2) { ?>

<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard_sucursales.php">Inicio</a></li>		  
		  <li class="active">Mis solicitudes</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Listado de mis solicitudes</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>		
				
				<table class="table" id="manageMisSolicitudesTable">
					<thead>
						<tr>
							<th style="width:10%;">Imagen</th>
							<th>Nombre del producto</th>
							<th>Cantidad</th>
							<th>solicitado a</th>
							<th>Estado</th>
							<!--<th style="width:15%;">Opciones</th>-->
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->






<script src="custom/js/misSolicitudes.js"></script>
<?php require_once 'includes/footer.php'; ?>
<?php }else{ echo "<script> alert('Su usuario no posee los permisos para entrar en esta vista, usted sera redireccionado.'); window.location.href = 'index.php' </script>";} ?>