<!-- edit addMiStock brand -->
<div class="modal fade" id="solicitarTraspasoModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	    	
		<form class="form-horizontal" id="solicitarTraspasoForm" action="php_action/solicitarTraspaso.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Solicitad traspaso</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-solicitarTraspaso-messages"></div>

	        <div class="form-group">
	        	<label for="cantidad" class="col-sm-4 control-label">Cantidad: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-7">
				      <input type="text" class="form-control" id="cantidad" placeholder="Agrega la cantidad" name="cantidad" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer solicitarTraspasoFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
	        
	        <button type="submit" class="btn btn-primary" id="solicitarTraspasoModalBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Solicitar</button>
	      </div> <!-- /modal-footer -->	      
     	</form> <!-- /.form -->	     
	      	      
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>