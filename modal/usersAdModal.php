<div class="modal fade" id="addUsersAdModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="submitUsersAdForm" action="php_action/createUsersAd.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Agregar usuario</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="add-usersAd-messages"></div>

	        <div class="form-group">
	        	<label for="usersName" class="col-sm-3 control-label">Username: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="usersAdName" placeholder="Nombre de usuario" name="usersAdName" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
	        
	        <div class="form-group">
	        	<label for="password" class="col-sm-3 control-label">Password: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="password" class="form-control" id="password" placeholder="Password" name="password" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->

	        <div class="form-group">
	        	<label for="email" class="col-sm-3 control-label">Email: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="email" class="form-control" id="email" placeholder="Email" name="email" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->


	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	        
	        <button type="submit" class="btn btn-primary" id="createUsersAdBtn" data-loading-text="Loading..." autocomplete="off">Guardar cambios</button>
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


<!-- edit usersAd -->
<div class="modal fade" id="editUsersAdModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editUsersAdForm" action="php_action/editUsersAd.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Editar usuario</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-usersAd-messages"></div>

	      	<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Cargando...</span>
					</div>

		      <div class="edit-usersAd-result">
		      	<div class="form-group">
		        	<label for="editUsersAdName" class="col-sm-3 control-label">Username: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="editUsersAdName" placeholder="Nombre de usuario" name="editUsersAdName" autocomplete="off">
					    </div>
		        </div> <!-- /form-group-->

		        <div class="form-group">
		        	<label for="editEmail" class="col-sm-3 control-label">Email: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <input type="email" class="form-control" id="editEmail" placeholder="Email" name="editEmail" autocomplete="off">
					    </div>
		        </div> <!-- /form-group-->


		      </div>
		      <!-- /edit usersAd result -->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer editUsersAdFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
	        
	        <button type="submit" class="btn btn-success" id="editUsersAdBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
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
<!-- /edit usersAd -->


<!-- remove usersAd -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Eliminar usuario</h4>
      </div>
      <div class="modal-body">
        <p>Realmente deseas eliminar este registro?</p>
      </div>
      <div class="modal-footer removeUsersAdFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
        <button type="button" class="btn btn-primary" id="removeUsersAdBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove usersAd -->

<!-- active usersAd -->
<div class="modal fade" tabindex="-1" role="dialog" id="activeMemberModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Activar usuario</h4>
      </div>
      <div class="modal-body">
        <p>Realmente deseas activar este registro?</p>
      </div>
      <div class="modal-footer activeUsersAdFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
        <button type="button" class="btn btn-primary" id="activeUsersAdBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /active usersAd -->

<!-- edit pass usersAd -->
<div class="modal fade" id="editPassUsersAdModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editPassUsersAdForm" action="php_action/editPassUsersAd.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Editar password</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-usersAd-pass-messages"></div>

		      <div class="edit-usersAd-result">
		      	<div class="form-group">
		        	<label for="passwordAdmin" class="col-sm-3 control-label">Ingrese password de administrador: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <input type="password" class="form-control" id="passwordAdmin" placeholder="Password administrador" name="passwordAdmin" autocomplete="off">
					    </div>
		        </div> <!-- /form-group-->

		        <div class="form-group">
		        	<label for="editEmail" class="col-sm-3 control-label">Nueva password para el usuario: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <input type="password" class="form-control" id="password1" placeholder="Password" name="password1" autocomplete="off">
					    </div>
		        </div> <!-- /form-group-->

		        <div class="form-group">
		        	<label for="password2" class="col-sm-3 control-label">Repita nueva password: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <input type="password" class="form-control" id="password2" placeholder="Password" name="password2" autocomplete="off">
					    </div>
		        </div> <!-- /form-group-->

		      </div>
		      <!-- /edit pass usersAd result -->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer editPassUsersAdFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
	        
	        <button type="submit" class="btn btn-success" id="editPassUsersAdBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
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
<!-- /edit pass usersAd -->