<!-- descontar MiStock brand -->
<div class="modal fade" id="descontarMiStockModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	    	
		<form class="form-horizontal" id="descontarMiStockForm" action="php_action/sumarMiStockDeSucursal.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Agregar a mi stock</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="descontar-miStock-messages"></div>

	        <div class="form-group">
	        	<label for="cantidad" class="col-sm-4 control-label">Cantidad: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="cantidad" placeholder="Cantidad" name="cantidad" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer descontarMiStockFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
	        
	        <button type="submit" class="btn btn-primary" id="descontarMiStockModalBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Agregar</button>
	      </div> <!-- /modal-footer -->	      
     	</form> <!-- /.form -->	     
	      	      
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>