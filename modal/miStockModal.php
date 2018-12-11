<!-- add miStock -->
<div class="modal fade" id="addMiStockModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

    	<form class="form-horizontal" id="submitMiStockForm" action="php_action/createMiStock.php" method="POST" enctype="multipart/form-data">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Agregar producto</h4>
	      </div>

	      <div class="modal-body" style="max-height:450px; overflow:auto;">

	      	<div id="add-miStock-messages"></div>

	      	<div class="form-group">
	        	<label for="MiStockImage" class="col-sm-3 control-label">Imagen: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
					    <!-- the avatar markup -->
							<div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>							
					    <div class="kv-avatar center-block">					        
					        <input type="file" class="form-control" id="miStockImage" placeholder="Imagen del producto" name="miStockImage" class="file-loading" style="width:auto;"/>
					    </div>
				      
				    </div>
	        </div> <!-- /form-group-->	     	           	       

	        <div class="form-group">
	        	<label for="miStockName" class="col-sm-3 control-label">Nombre: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="miStockName" placeholder="Nombre del producto" name="miStockName" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	    

	        <div class="form-group">
	        	<label for="quantity" class="col-sm-3 control-label">Stock: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="quantity" placeholder="Stock" name="quantity" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->

	        <div class="form-group">
	        	<label for="priceMenudeo" class="col-sm-3 control-label">Precio: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="priceMenudeo" placeholder="Precio" name="priceMenudeo" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->

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
	        	<label for="categoryName" class="col-sm-3 control-label">Categoría: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select type="text" class="form-control" id="categoryName" placeholder="Product Name" name="categoryName" >
				      	<option value="">-- Selecciona --</option>
				      	<?php 
				      	$sql = "SELECT categories_id, categories_name, categories_active, categories_status FROM categories WHERE categories_status = 1 AND categories_active = 1";
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
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
	        
	        <button type="submit" class="btn btn-primary" id="createMiStockBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
	      </div> <!-- /modal-footer -->	      
     	</form> <!-- /.form -->	     
    </div> <!-- /modal-content -->    
  </div> <!-- /modal-dailog -->
</div> 
<!-- /add categories -->


<!-- edit categories brand -->
<div class="modal fade" id="editMiStockModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	    	
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Editar producto</h4>
	      </div>
	      <div class="modal-body" style="max-height:450px; overflow:auto;">

	      	<div class="div-loading">
	      		<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Cargando...</span>
	      	</div>

	      	<div class="div-result">

				  <!-- Nav tabs -->
				  <ul class="nav nav-tabs" role="tablist">
				    <li role="presentation" class="active"><a href="#photo" aria-controls="home" role="tab" data-toggle="tab">Imagen</a></li>
				    <li role="presentation"><a href="#miStockInfo" aria-controls="profile" role="tab" data-toggle="tab">Información del producto</a></li>    
				  </ul>

				  <!-- Tab panes -->
				  <div class="tab-content">

				  	
				    <div role="tabpanel" class="tab-pane active" id="photo">
				    	<form action="php_action/editMiStockImage.php" method="POST" id="updateMiStockImageForm" class="form-horizontal" enctype="multipart/form-data">

				    	<br />
				    	<div id="edit-miStockPhoto-messages"></div>

				    	<div class="form-group">
			        	<label for="editMiStockImage" class="col-sm-3 control-label">Imagen: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">							    				   
						      <img src="" id="getMiStockImage" class="thumbnail" style="width:250px; height:250px;" />
						    </div>
			        </div> <!-- /form-group-->	     	           	       
				    	
			      	<div class="form-group">
			        	<label for="editMiStockImage" class="col-sm-3 control-label">Selecciona imagen: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
							    <!-- the avatar markup -->
									<div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>							
							    <div class="kv-avatar center-block">					        
							        <input type="file" class="form-control" id="editMiStockImage" placeholder="Product Name" name="editMiStockImage" class="file-loading" style="width:auto;"/>
							    </div>
						      
						    </div>
			        </div> <!-- /form-group-->	     	           	       

			        <div class="modal-footer editMiStockPhotoFooter">
				        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
				        
				        <!-- <button type="submit" class="btn btn-success" id="editMiStockImageBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button> -->
				      </div>
				      <!-- /modal-footer -->
				      </form>
				      <!-- /form -->
				    </div>
				    <!-- miStock image -->
				    <div role="tabpanel" class="tab-pane" id="miStockInfo">
				    	<form class="form-horizontal" id="editMiStockForm" action="php_action/editMiStock.php" method="POST">				    
				    	<br />

				    	<div id="edit-miStock-messages"></div>

				    	<div class="form-group">
			        	<label for="editMiStockName" class="col-sm-3 control-label">Nombre: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editMiStockName" placeholder="Nombre del producto" name="editMiStockName" autocomplete="off">
						    </div>
			        </div> <!-- /form-group-->	    

			        <div class="form-group">
			        	<label for="editQuantity" class="col-sm-3 control-label">Stock: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editQuantity" placeholder="Stock" name="editQuantity" autocomplete="off">
						    </div>
			        </div> <!-- /form-group-->

			        <div class="form-group">
			        	<label for="editPriceMenudeo" class="col-sm-3 control-label">Precio: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editPriceMenudeo" placeholder="Precio" name="editPriceMenudeo" autocomplete="off">
						    </div>
			        </div> <!-- /form-group-->

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
			        	<label for="editCategoryName" class="col-sm-3 control-label">Categoría: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <select type="text" class="form-control" id="editCategoryName" name="editCategoryName" >
						      	<option value="">-- Selecciona --</option>
						      	<?php 
						      	$sql = "SELECT categories_id, categories_name, categories_active, categories_status FROM categories WHERE categories_status = 1 AND categories_active = 1";
										$result = $connect->query($sql);

										while($row = $result->fetch_array()) {
											echo "<option value='".$row[0]."'>".$row[1]."</option>";
										} // while
										
						      	?>
						      </select>
						    </div>
			        </div> <!-- /form-group-->

			        <div class="modal-footer editMiStockFooter">
				        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
				        
				        <button type="submit" class="btn btn-success" id="editMiStockBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
				      </div> <!-- /modal-footer -->				     
			        </form> <!-- /.form -->				     	
				    </div>    
				    <!-- /miStock info -->
				  </div>

				</div>
	      	
	      </div> <!-- /modal-body -->
	      	      
     	
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- /categories brand -->

<!-- categories brand -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeMiStockModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Eliminar producto</h4>
      </div>
      <div class="modal-body">

      	<div class="removeMiStockMessages"></div>

        <p>Realmente deseas eliminar el producto?</p>
      </div>
      <div class="modal-footer removeMiStockFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cancelar</button>
        <button type="button" class="btn btn-primary" id="removeMiStockBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Eliminar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- descontar MiStock brand -->
<div class="modal fade" id="descontarMiStockModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	    	
		<form class="form-horizontal" id="descontarMiStockForm" action="php_action/descontarMiStock.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Descontar de stock</h4>
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
	        
	        <button type="submit" class="btn btn-primary" id="descontarMiStockModalBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Descontar</button>
	      </div> <!-- /modal-footer -->	      
     	</form> <!-- /.form -->	     
	      	      
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>