<?php require_once 'config/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>
<?php include ("notification.php"); ?>
<?php if ($_SESSION['rol'] == 3 || $_SESSION['rol'] == 4) { ?>

<!-- add miStock -->
<div class="modal fade" id="addMiStockModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Agregar producto</h4>
	      </div>

	      <div class="modal-body" style="max-height:450px; overflow:auto;">
			<div class="row" style="padding: 0px 15px;">
				<button type="button" onclick="addProductoSucursal()" class="col-md-6 btn btn-default" data-dismiss="modal">De mi sucursal</button>
				<button type="button" onclick="addProductoAdmin()" class="col-md-6 btn btn-default" data-dismiss="modal">Del stock general</button>
			</div>
	      </div> <!-- /modal-body -->
    
    </div> <!-- /modal-content -->    
  </div> <!-- /modal-dailog -->
</div> 
<!-- /add categories -->


<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard_sucursales.php">Inicio</a></li>		  
		  <li class="active">Productos</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Listado de productos</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" id="addMiStockModalBtn" data-target="#addMiStockModal"> <i class="glyphicon glyphicon-plus-sign"></i> Agregar producto </button>
				</div> <!-- /div-action -->				
				
				<table class="table" id="manageMiStockTable">
					<thead>
						<tr>
							<th style="width:10%;">Imagen</th>	
							<th>Nombre del producto</th>
							<th>Precio</th>
							<th>Stock</th>
							<th>Fabricante</th>
							<th>Categoría</th>
<!--							<th style="width:15%;">Opciones</th>-->
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->


<script src="custom/js/miStockPropio.js"></script>
<?php require_once 'includes/footer.php'; ?>
<?php }else{ echo "<script> alert('Su usuario no posee los permisos para entrar en esta vista, usted sera redireccionado.'); window.location.href = 'index.php' </script>";} ?>