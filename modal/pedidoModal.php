<div class="modal fade" id="addPedidoModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="submitPedidoForm" action="php_action/createPedido.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Agregar pedido</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="add-pedido-messages"></div>

	      	<div class="form-group">
	        	<label for="brandName" class="col-sm-3 control-label">Fabricante: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control" id="brandName" name="brandName">
				      	<option value="">-- Selecciona --</option>
				      	<?php 
				      	$sql = "SELECT brand_id, brand_name, brand_active, brand_status FROM brands WHERE brand_status = 1 AND brand_active = 1";
								$result = $connect->query($sql);

								while($row = $result->fetch_array()) {
									echo "<option value='".$row[0]."'>".$row[1]."</option>";
								} // while
								
				      	?>
				      </select>
				    </div>
	        </div> <!-- /form-group-->

	        <div class="form-group">
	        	<label for="pedidoName" class="col-sm-3 control-label">Descripción del pedido: </label>
		        <label class="col-sm-1 control-label">: </label>
			    <div class="col-sm-8">
				    <input type="text" class="form-control" id="pedidoName" placeholder="Descripción del pedido" name="pedidoName" autocomplete="off">
				</div>
	        </div> <!-- /form-group-->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer addPedidoFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	        
	        <button type="submit" class="btn btn-primary" id="createPedidoBtn" data-loading-text="Loading..." autocomplete="off">Guardar cambios</button>
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- / add modal -->


<!-- edit pedido -->
<div class="modal fade" id="editPedidoModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editPedidoForm" action="php_action/editPedido.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Editar pedido</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-pedido-messages"></div>

	      	<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Cargando...</span>
					</div>

		      <div class="edit-pedido-result">

		      	<div class="form-group">
		        	<label for="editBrandName" class="col-sm-3 control-label">Fabricante: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <select class="form-control" id="editBrandName" name="editBrandName">
					      	<option value="">-- Selecciona --</option>
					      	<?php 
					      	$sql = "SELECT brand_id, brand_name, brand_active, brand_status FROM brands WHERE brand_status = 1 AND brand_active = 1";
									$result = $connect->query($sql);

									while($row = $result->fetch_array()) {
										echo "<option value='".$row[0]."'>".$row[1]."</option>";
									} // while
									
					      	?>
					      </select>
					    </div>
		        </div> <!-- /form-group-->

		      	<div class="form-group">
					<label for="editPedidoName" class="col-sm-3 control-label">Descripción del pedido: </label>
		        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
					    <input type="text" class="form-control" id="editPedidoName" placeholder="Descripción del pedido" name="editPedidoName" autocomplete="off">
					</div>
		        </div> <!-- /form-group-->	         	        

		      </div>         	        
		      <!-- /edit pedido result -->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer editPedidoFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
	        
	        <button type="submit" class="btn btn-success" id="editPedidoBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- / add modal -->
<!-- /edit pedido -->


<!-- remove pedido -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Eliminar pedido</h4>
      </div>
      <div class="modal-body">
        <p>Realmente deseas eliminar este registro?</p>
      </div>
      <div class="modal-footer removePedidoFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
        <button type="button" class="btn btn-primary" id="removePedidoBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove pedido -->