<div class="modal fade" id="addCreditosModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="submitCreditosForm" action="php_action/createCreditos.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Agregar créditos</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="add-creditos-messages"></div>

	        <div class="form-group">
	        	<label for="creditosCantidad" class="col-sm-3 control-label">Créditos: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" min="0" value="0.00" step=".01" class="form-control" id="creditosCantidad" placeholder="Cantidad de créditos" name="creditosCantidad" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	         	        
	        <div class="form-group">
	        	<label for="sucursalId" class="col-sm-3 control-label">Sucursal: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
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
			    <label for="creditosFechaLimite" class="col-sm-3 control-label">Fecha límite del crédito</label>
			    <label class="col-sm-1 control-label">: </label>
			    <div class="col-sm-8">
			    	<input type="text" class="form-control" id="creditosFechaLimite" name="creditosFechaLimite" autocomplete="off" />
			    </div>
			</div> <!--/form-group-->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	        
	        <button type="submit" class="btn btn-primary" id="createCreditosBtn" data-loading-text="Loading..." autocomplete="off">Guardar cambios</button>
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


<!-- edit creditos -->
<div class="modal fade" id="editCreditosModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editCreditosForm" action="php_action/editCreditos.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Editar créditos</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-creditos-messages"></div>

	      	<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Cargando...</span>
					</div>

		      <div class="edit-creditos-result">
		      	<div class="form-group">
		        	<label for="editCreditosCantidad" class="col-sm-3 control-label">Créditos: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="editCreditosCantidad" placeholder="Cantidad de créditos" name="editCreditosCantidad" autocomplete="off">
					    </div>
		        </div> <!-- /form-group-->	         	        
		        <div class="form-group">
		        	<label for="editSucursalId" class="col-sm-3 control-label">Sucursal: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <select class="form-control" id="editSucursalId" name="editSucursalId">
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
				    <label for="editCreditosFechaLimite" class="col-sm-3 control-label">Fecha límite del crédito</label>
				    <label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				    	<input type="text" class="form-control" id="editCreditosFechaLimite" name="editCreditosFechaLimite" autocomplete="off" />
				    </div>
				</div> <!--/form-group-->

		      </div>         	        
		      <!-- /edit creditos result -->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer editCreditosFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
	        
	        <button type="submit" class="btn btn-success" id="editCreditosBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
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
<!-- /edit creditos -->


<!-- remove creditos -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Eliminar el créditos</h4>
      </div>
      <div class="modal-body">
        <p>Realmente deseas eliminar este registro?</p>
      </div>
      <div class="modal-footer removeCreditosFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
        <button type="button" class="btn btn-primary" id="removeCreditosBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove creditos -->