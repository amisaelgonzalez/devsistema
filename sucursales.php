<?php require_once 'includes/header.php'; ?>
<?php include('modal/sucursalesModal.php');?>
<?php include ("notification.php"); ?>  
<?php if ($_SESSION['rol'] == 1) { ?>

<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Inicio</a></li>		  
		  <li class="active">Sucursales</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading">  Listado de Sucursales</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:40px;">
					<button class="btn btn-primary btn-success" data-toggle="modal" data-target="#addSucursalesModel"> <i class="glyphicon glyphicon-plus"></i> Agregar sucursal </button>
				</div> <!-- /div-action -->				
				
				<table class="table" id="manageSucursalesTable">
					<thead>
						<tr>							
							<th>Nombre</th>
							<th>Créditos Totales</th>
							<th style="width:15%;">Opciones</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->







<script src="custom/js/sucursales.js"></script>

<?php require_once 'includes/footer.php'; ?>
<?php }else{ echo "<script> alert('Su usuario no posee los permisos para entrar en esta vista, usted sera redireccionado.'); window.location.href = 'index.php' </script>";} ?>