<div class="modal fade" id="addSucursalesModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="submitSucursalesForm" action="php_action/createSucursales.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Agregar sucursales</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="add-sucursales-messages"></div>

	        <div class="form-group">
	        	<label for="sucursalesName" class="col-sm-3 control-label">Nombre: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="sucursalesName" placeholder="Nombre de la sucursal" name="sucursalesName" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	        
	        <button type="submit" class="btn btn-primary" id="createSucursalesBtn" data-loading-text="Loading..." autocomplete="off">Guardar cambios</button>
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


<!-- edit sucursales -->
<div class="modal fade" id="editSucursalesModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editSucursalesForm" action="php_action/editSucursales.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Editar sucursal</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-sucursales-messages"></div>

	      	<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Cargando...</span>
					</div>

		      <div class="edit-sucursales-result">
		      	
		      	<div class="form-group">
		        	<label for="editSucursalesName" class="col-sm-3 control-label">Nombre: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="editSucursalesName" placeholder="Nombre de la sucursal" name="editSucursalesName" autocomplete="off">
					    </div>
		        </div> <!-- /form-group-->	         	        
	
		      </div>         	        
		      <!-- /edit sucursales result -->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer editSucursalesFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
	        
	        <button type="submit" class="btn btn-success" id="editSucursalesBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
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
<!-- /edit sucursales -->


<!-- remove sucursales -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Eliminar sucursal</h4>
      </div>
      <div class="modal-body">
        <p>Realmente deseas eliminar este registro?</p>
      </div>
      <div class="modal-footer removeSucursalesFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
        <button type="button" class="btn btn-primary" id="removeSucursalesBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove sucursales -->

<!-- edit sucursales credito -->
<div class="modal fade" id="editSucursalesCreditoModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editSucursalesCreditoForm" action="php_action/editSucursalesCredito.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Añadir crédito</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-sucursales-credito-messages"></div>

	      	<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Cargando...</span>
					</div>

		      <div class="edit-sucursales-credito-result">
		      	
		      	<div class="form-group">
		        	<label for="editSucursalesCredito" class="col-sm-3 control-label">Créditos: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="editSucursalesCredito" placeholder="Cantidad de créditos" name="editSucursalesCredito" autocomplete="off">
					    </div>
		        </div> <!-- /form-group-->	 

		        <div class="form-group">
				    <label for="editSucursalesFechaLimite" class="col-sm-3 control-label">Fecha límite del crédito</label>
				    <label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				    	<input type="text" class="form-control" id="editSucursalesFechaLimite" name="editSucursalesFechaLimite" autocomplete="off" />
				    </div>
				</div> <!--/form-group-->        	        
	
		      </div>         	        
		      <!-- /edit sucursales credito result -->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer editSucursalesCreditoFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
	        
	        <button type="submit" class="btn btn-success" id="editSucursalesCreditoBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
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
<!-- /edit sucursales credito -->