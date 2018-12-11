<!-- aprobar traspaso -->
<div class="modal fade" tabindex="-1" role="dialog" id="aprobarTraspasoModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-ok-sign"></i> Aprobar traspaso</h4>
      </div>
      <div class="modal-body">

        <div class="aprobarTraspasoMessages"></div>

        <p>Realmente deseas aprobar el traspaso?</p>
      </div>
      <div class="modal-footer aprobarTraspasoFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> No</button>
        <button type="button" class="btn btn-primary" id="aprobarTraspasoBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Si</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- cancelar traspaso -->
<div class="modal fade" tabindex="-1" role="dialog" id="cancelarTraspasoModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-remove-sign"></i> Cancelar traspaso</h4>
      </div>
      <div class="modal-body">

      	<div class="cancelarTraspasoMessages"></div>

        <p>Realmente deseas cancelar el traspaso?</p>
      </div>
      <div class="modal-footer cancelarTraspasoFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> No</button>
        <button type="button" class="btn btn-primary" id="cancelarTraspasoBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Si</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->