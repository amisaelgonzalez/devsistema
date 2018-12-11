<!-- edit addMiStock brand -->
<div class="modal fade" id="editStockGeneralModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	    	
		<form class="form-horizontal" id="editStockGeneralForm" action="php_action/addMiStock.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Agregar a mi stock</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-stockGeneral-messages"></div>

	        <div class="form-group">
	        	<label for="editQuantity" class="col-sm-4 control-label">Cantidad: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-7">
				      <input type="text" class="form-control" id="editQuantity" placeholder="Agrega la cantidad" name="editQuantity" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
	        
	        <button type="submit" class="btn btn-primary" id="editStockGeneralBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
	      </div> <!-- /modal-footer -->	      
     	</form> <!-- /.form -->	     
	      	      
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>