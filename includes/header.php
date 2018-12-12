<?php require_once 'config/core.php';?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html">
<meta charset="UTF-8">
  <title>Sistema de Gestión de Inventario</title>

  <!-- bootstrap -->
  <link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
  <!-- bootstrap theme-->
  <link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">
  <!-- font awesome -->
  <link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">

  <!-- custom css -->
  <link rel="stylesheet" href="custom/css/custom.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="assests/plugins/datatables/jquery.dataTables.min.css">

  <!-- file input -->
  <link rel="stylesheet" href="assests/plugins/fileinput/css/fileinput.min.css">

  <!-- jquery -->
  <script src="assests/jquery/jquery.min.js"></script>
  <!-- jquery ui -->
  <link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
  <script src="assests/jquery-ui/jquery-ui.min.js"></script>

  <!-- bootstrap js -->
  <script src="assests/bootstrap/js/bootstrap.min.js"></script>


  <!-- Fuente de Google -->
  <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">


</head>

<script type="text/javascript">
$(document).ready(function(){
    $('.btn-Notification').on('click', function(){
        var ContainerNoty=$('.container-notifications');
        var NotificationArea=$('.NotificationArea');
        if(NotificationArea.hasClass('NotificationArea-show')&&ContainerNoty.hasClass('container-notifications-show')){
            NotificationArea.removeClass('NotificationArea-show');
            ContainerNoty.removeClass('container-notifications-show');
        }else{
            NotificationArea.addClass('NotificationArea-show');
            ContainerNoty.addClass('container-notifications-show');
        }
    });
})
</script>
<body>

  <nav class="navbar navbar-default navbar-static-top">
    <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>



<?php
switch ($_SESSION['rol']) {
    case '1':
?>
<ul class="nav navbar-nav navbar-right">

       
        <li id="navDashboard"><a href="index.php"><i class="glyphicon glyphicon-list-alt"></i>  Inicio</a></li> 

<!--        <li class="dropdown" id="navPuntoSucursal">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-list-alt"></i> Punto de Venta <span class="caret"></span></a>
          <ul class="dropdown-menu">            
            <li id="topNavAddPuntoSucursal"><a href="punto.php?o=add"> <i class="glyphicon glyphicon-plus"></i> Agregar Compra</a></li>            
            <li id="topNavManagePuntoSucursal"><a href="punto.php?o=manord"> <i class="glyphicon glyphicon-edit"></i> Gestionar Ventas</a></li>
         
          </ul>
        </li> -->
        
        <li class="dropdown" id="navOrder">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-shopping-cart"></i> Punto de venta <span class="caret"></span></a>
          <ul class="dropdown-menu">            
            <li id="topNavAddOrder"><a href="puntoDeVenta.php"> <i class="glyphicon glyphicon-plus"></i> Agregar Venta</a></li>            
            <li id="topNavManageOrder"><a href="gestionPuntoDeVenta.php"> <i class="glyphicon glyphicon-edit"></i> Gestionar Ordenes</a></li>          
          </ul>
        </li> 
        
        <li id="navSucursales"><a href="sucursales.php"><i class="glyphicon glyphicon-home"></i>  Sucursales</a></li>

        <li id="navBrand"><a href="brand.php"><i class="glyphicon glyphicon-btc"></i>  Fabricantes</a></li>

        <li id="navPedido"><a href="pedido.php"><i class="glyphicon glyphicon-list-alt"></i>  Pedidos</a></li>

        <li id="navCategories"><a href="categories.php"> <i class="glyphicon glyphicon-th-list"></i> Categorías</a></li>        

        <li id="navProduct"><a href="product.php"> <i class="glyphicon glyphicon-ruble"></i> Productos </a></li>     

        <li class="dropdown" id="navOrder">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-piggy-bank"></i> Cr&eacute;ditos <span class="caret"></span></a>
          <ul class="dropdown-menu">            
            <li id="topNavAddOrder"><a href="orders.php?o=add"> <i class="glyphicon glyphicon-plus"></i> Agregar Cr&eacute;ditos</a></li>            
            <li id="topNavManageOrder"><a href="orders.php?o=manord"> <i class="glyphicon glyphicon-edit"></i> Gestionar Cr&eacute;ditos</a></li>

            <li id="navCreditos"><a href="creditos.php"> <i class="glyphicon glyphicon-list-alt"></i> Gestionar Cr&eacute;ditos Sucursales</a></li>   
            <li id="navPedidoSucursalListado"><a href="pedidos_sucursal_listado.php?o=manord"> <i class="glyphicon glyphicon-list-alt"></i> Ver pedidos de sucursales</a></li>
          </ul>
        </li> 

        

        <li id="navUsers"><a href="users.php"><i class="glyphicon glyphicon-user"></i> Usuarios </a></li>

        <!-- Notifications Menu -->
          <li class="dropdown notifications-menu btn-Notification" id="notifications">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
<!--              <span class="label label-primary">10</span>-->
            </a>
          </li>

        <li class="dropdown" id="navSetting">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-cog"></i> <span class="caret"></span></a>
          <ul class="dropdown-menu">            
            <li id="topNavSetting"><a href="setting.php"> <i class="glyphicon glyphicon-wrench"></i> Configuración</a></li>

            <li id="navReport"><a href="report.php"> <i class="glyphicon glyphicon-check"></i> Reportes </a></li>

            <li id="topNavLogout"><a href="logout.php"> <i class="glyphicon glyphicon-log-out"></i> Salir</a></li>            
          </ul>
        </li> 
      </ul>

<?php 
        break;

    case '2':

 ?>
<ul class="nav navbar-nav navbar-right">
        <li id="navDashboard"><a href="dashboard_sucursales.php"><i class="glyphicon glyphicon-list-alt"></i>  Inicio</a></li>

        <li class="dropdown" id="navPedidoSucursal">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-list-alt"></i> Pedidos <span class="caret"></span></a>
          <ul class="dropdown-menu">            
            <li id="topNavAddPedidoSucursal"><a href="pedidos_sucursal.php?o=add"> <i class="glyphicon glyphicon-plus"></i> Agregar Pedidos</a></li>            
            <li id="topNavManagePedidoSucursal"><a href="pedidos_sucursal.php?o=manord"> <i class="glyphicon glyphicon-edit"></i> Gestionar Pedidos</a></li>
         
          </ul>
        </li> 

        <li class="dropdown" id="navPedidoSucursal">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-list-alt"></i> Stock <span class="caret"></span></a>
          <ul class="dropdown-menu">
            
            <li id="topNavMiStock"><a href="mi_stock.php"> <i class="glyphicon glyphicon-list-alt"></i> Mi stock</a></li>

            <li id="topNavStockGeneral"><a href="stock_general.php"> <i class="glyphicon glyphicon-list-alt"></i> Stock general</a></li>

            <li id="topNavStockPorSucursal"><a href="stock_sucursal.php"> <i class="glyphicon glyphicon-list-alt"></i> Stock por sucursal</a></li>
         
          </ul>
        </li>

        <li id="navMisSolicitudes"><a href="mis_solicitudes.php"><i class="glyphicon glyphicon-import"></i> Mis solicitudes </a></li>

        <li id="navSolicitudes"><a href="solicitudes.php"><i class="glyphicon glyphicon-export"></i> Solicitudes </a></li>

        <li id="navUsersAd"><a href="users_ad.php"><i class="glyphicon glyphicon-user"></i> Usuarios </a></li>

        <!-- Notifications Menu -->
        <li class="dropdown notifications-menu btn-Notification" id="notifications">
          <!-- Menu toggle button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>
<!--              <span class="label label-primary">10</span>-->
          </a>
        </li>

        <li class="dropdown" id="navSetting">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-cog"></i> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li id="topNavSetting"><a href="setting.php"> <i class="glyphicon glyphicon-wrench"></i> Configuración</a></li>
            <li id="topNavLogout"><a href="logout.php"> <i class="glyphicon glyphicon-log-out"></i> Salir</a></li>
          </ul>
        </li>
      </ul>
<?php
        break;

    case '3':
?>
<ul class="nav navbar-nav navbar-right">


        <li class="dropdown" id="navOrder">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-shopping-cart"></i> Punto de venta <span class="caret"></span></a>
          <ul class="dropdown-menu">            
            <li id="topNavAddOrder"><a href="puntoDeVenta.php"> <i class="glyphicon glyphicon-plus"></i> Agregar Venta</a></li>            
            <li id="topNavManageOrder"><a href="gestionPuntoDeVenta.php"> <i class="glyphicon glyphicon-edit"></i> Gestionar Ordenes</a></li>          
          </ul>
        </li> 

>


        <li class="dropdown" id="navPedidoSucursal">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-list-alt"></i> Stock <span class="caret"></span></a>
          <ul class="dropdown-menu">

            <li id="navProduct"><a href="stock.php"> <i class="glyphicon glyphicon-ruble"></i> Stock </a></li>
            <li id="topNavStockPorSucursal"><a href="stock_sucursal.php"> <i class="glyphicon glyphicon-list-alt"></i> Stock por sucursal</a></li>
         
          </ul>
        </li>

        <li class="dropdown" id="navOrder">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-piggy-bank"></i> Cr&eacute;ditos <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li id="topNavAddOrder"><a href="orders_users.php?o=add"> <i class="glyphicon glyphicon-plus"></i> Agregar Cr&eacute;ditos</a></li>
            <li id="topNavManageOrder"><a href="orders_users.php?o=manord"> <i class="glyphicon glyphicon-edit"></i> Gestionar Cr&eacute;ditos</a></li>
          </ul>
        </li>

        <li class="dropdown" id="navSetting">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-cog"></i> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li id="topNavSetting"><a href="setting.php"> <i class="glyphicon glyphicon-wrench"></i> Configuración</a></li>
            <li id="topNavLogout"><a href="logout.php"> <i class="glyphicon glyphicon-log-out"></i> Salir</a></li>
          </ul>
        </li>
      </ul>
<?php
        break;

    case '4':
?>
<ul class="nav navbar-nav navbar-right">

        <li id="navDashboard"><a href="dashboard.php"><i class="glyphicon glyphicon-list-alt"></i>  Inicio</a></li> 

        <li class="dropdown" id="navOrder">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-shopping-cart"></i> Punto de venta <span class="caret"></span></a>
          <ul class="dropdown-menu">            
            <li id="topNavAddOrder"><a href="puntoDeVenta.php"> <i class="glyphicon glyphicon-plus"></i> Agregar Venta</a></li>            
            <li id="topNavManageOrder"><a href="gestionPuntoDeVenta.php"> <i class="glyphicon glyphicon-edit"></i> Gestionar Ordenes</a></li>          
          </ul>
        </li>       
        
        <li class="dropdown" id="navOrder">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-piggy-bank"></i> Cr&eacute;ditos <span class="caret"></span></a>
          <ul class="dropdown-menu">            
            <li id="topNavAddOrder"><a href="orders.php?o=add"> <i class="glyphicon glyphicon-plus"></i> Agregar Cr&eacute;ditos</a></li>            
            <li id="topNavManageOrder"><a href="orders.php?o=manord"> <i class="glyphicon glyphicon-edit"></i> Gestionar Cr&eacute;ditos</a></li>
          </ul>
        </li> 

        <li id="navReport"><a href="clientPuntoDeVenta.php"> <i class="glyphicon glyphicon-user"></i> Clientes </a></li>

        <li id="navReport"><a href="report.php"> <i class="glyphicon glyphicon-check"></i> Reportes </a></li>

        <li class="dropdown" id="navSetting">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-cog"></i> <span class="caret"></span></a>
          <ul class="dropdown-menu">            
            <li id="topNavSetting"><a href="setting.php"> <i class="glyphicon glyphicon-wrench"></i> Configuración</a></li>            
            <li id="topNavLogout"><a href="logout.php"> <i class="glyphicon glyphicon-log-out"></i> Salir</a></li>            
          </ul>
        </li> 
      </ul>

<?php 
        break;
}
?>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
  </nav>

  <div class="container">
