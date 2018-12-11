<div class="modal fade" id="addUsersModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="submitUsersForm" action="php_action/createUsers.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Agregar usuario</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="add-users-messages"></div>

	        <div class="form-group">
	        	<label for="usersName" class="col-sm-3 control-label">Username: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="usersName" placeholder="Nombre de usuario" name="usersName" autocomplete="off">
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

	        <div class="form-group">
	        	<label for="rol" class="col-sm-3 control-label">Rol: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control" id="rol" name="rol" onchange="habilitarCombo(this.value);">
				      	<option value="">-- Seleciona--</option>
				      	<option value="1">Super admin</option>
				      	<option value="4">Adminstrador créditos</option>
				      	<option value="2">Adminstrador sucursal</option>
				      	<option value="3">Usuario</option>
				      </select>
				    </div>
	        </div> <!-- /form-group-->

	        <div class="form-group" id="divSucursal" style="display: none;">
	        	<label for="sucursal" class="col-sm-3 control-label">Sucursal: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control" id="sucursal" name="sucursal">
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


	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	        
	        <button type="submit" class="btn btn-primary" id="createUsersBtn" data-loading-text="Loading..." autocomplete="off">Guardar cambios</button>
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


<!-- edit users -->
<div class="modal fade" id="editUsersModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editUsersForm" action="php_action/editUsers.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Editar usuario</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-users-messages"></div>

	      	<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Cargando...</span>
					</div>

		      <div class="edit-users-result">
		      	<div class="form-group">
		        	<label for="editUsersName" class="col-sm-3 control-label">Username: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="editUsersName" placeholder="Nombre de usuario" name="editUsersName" autocomplete="off">
					    </div>
		        </div> <!-- /form-group-->

		        <div class="form-group">
		        	<label for="editEmail" class="col-sm-3 control-label">Email: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <input type="email" class="form-control" id="editEmail" placeholder="Email" name="editEmail" autocomplete="off">
					    </div>
		        </div> <!-- /form-group-->

		        <div class="form-group">
		        	<label for="editRol" class="col-sm-3 control-label">Rol: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <select class="form-control" id="editRol" name="editRol" onchange="habilitarCombo(this.value);">
					      	<option value="">-- Seleciona--</option>
					      	<option value="1">Super admin</option>
					      	<option value="4">Adminstrador créditos</option>
					      	<option value="2">Adminstrador sucursal</option>
					      	<option value="3">Usuario</option>
					      </select>
					    </div>
		        </div> <!-- /form-group-->

		        <div class="form-group" id="divEditSucursal" style="display: none;">
		        	<label for="editSucursal" class="col-sm-3 control-label">Sucursal: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <select class="form-control" id="editSucursal" name="editSucursal">
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

		      </div>
		      <!-- /edit users result -->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer editUsersFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
	        
	        <button type="submit" class="btn btn-success" id="editUsersBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
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
<!-- /edit users -->


<!-- remove users -->
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
      <div class="modal-footer removeUsersFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
        <button type="button" class="btn btn-primary" id="removeUsersBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove users -->

<!-- active users -->
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
      <div class="modal-footer activeUsersFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
        <button type="button" class="btn btn-primary" id="activeUsersBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /active users -->

<!-- edit pass users -->
<div class="modal fade" id="editPassUsersModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editPassUsersForm" action="php_action/editPassUsers.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Editar password</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-users-pass-messages"></div>

		      <div class="edit-users-result">
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
		      <!-- /edit pass users result -->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer editPassUsersFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
	        
	        <button type="submit" class="btn btn-success" id="editPassUsersBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
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
<!-- /edit pass users -->