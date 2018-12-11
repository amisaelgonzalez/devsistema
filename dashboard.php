<?php require_once 'includes/header.php'; ?>
<?php include ("notification.php"); ?>  
<?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 4) { ?>

<?php 

$sql = "SELECT * FROM product WHERE status = 1";
$query = $connect->query($sql);
$countProduct = $query->num_rows;

$orderSql = "SELECT * FROM orders WHERE order_status = 1";
$orderQuery = $connect->query($orderSql);
$countOrder = $orderQuery->num_rows;

$totalRevenue = 0 ;
while ($orderResult = $orderQuery->fetch_assoc()) {
	$totalRevenue += $orderResult['paid'];
}

$lowStockSql = "SELECT * FROM product WHERE quantity <= 3 AND status = 1";
$lowStockQuery = $connect->query($lowStockSql);
$countLowStock = $lowStockQuery->num_rows;


$sql_creditos = "SELECT o.order_id as id, o.order_date as fecha FROM orders o INNER JOIN sucursales s ON s.sucursales_id = o.client_name WHERE o.order_status = 1";

$query_creditos = $connect->query($sql_creditos);
$aux = "";
while ($rows_creditos = $query_creditos->fetch_assoc()) {

	$aux .= "{id: '".$rows_creditos['id']."', title: 'Vencimiento de créditos', url: 'orders.php?o=calendarEvent&id=".$rows_creditos['id']."', start: '".$rows_creditos['fecha']."', className: 'credito_publicado'},";

}

$connect->close();

?>




<!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.print.css" media="print">


<div class="row">
	
	<div class="col-md-4">
		<div class="panel" style="background-color: #008C1F">
			<div class="panel-heading">
				<a href="product.php" style="text-decoration:none;color:#FFF;">
					Total de productos
					<span class="badge pull pull-right"><?php echo $countProduct; ?></span>	
				</a>
				
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->

	<div class="col-md-4">
		<div class="panel" style="background-color: #027093">
			<div class="panel-heading">
				<a href="orders.php?o=manord" style="text-decoration:none;color:#FFF;">
					Total cr&eacute;ditos
					<span class="badge pull pull-right"><?php echo $countOrder; ?></span>
				</a>
					
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->

	<div class="col-md-4">
		<div class="panel" style="background-color: #E11411">
			<div class="panel-heading">
				<a href="product.php" style="text-decoration:none;color:#FFF;">
					Inventario bajo
					<span class="badge pull pull-right"><?php echo $countLowStock; ?></span>	
				</a>
				
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->

	<div class="col-md-4">
		<div class="card">
		  <div class="cardHeader" style="background-color: #01B641">
		    <h1><?php echo date('d'); ?></h1>
		  </div>

		  <div class="cardContainer">
		    <p><?php echo date('l') .' '.date('d').', '.date('Y'); ?></p>
		  </div>
		</div> 
		<br/>

		<div class="card">
		  <div class="cardHeader" style="background-color:#015383;">
		    <h1><?php if($totalRevenue) {
		    	echo number_format($totalRevenue,2);
		    	} else {
		    		echo '0';
		    		} ?></h1>
		  </div>

		  <div class="cardContainer">
		    <p> <i class="glyphicon glyphicon-usd"></i> Ingresos totales</p>
		  </div>
		</div> 

	</div>

	<div class="col-md-8">
		<div class="panel" style="background-color: #F4F4F4">
			<div class="panel-heading" style="background-color: #E3E2E0"> <i class="glyphicon"></i></div>
			<div class="panel-body">
				<div id="calendar"></div>
			</div>	
		</div>
		
	</div>

	
</div> <!--/row-->

<!-- fullCalendar 2.2.5 -->
<script src="assests/plugins/moment/moment.min.js"></script>
<script src="assests/plugins/fullcalendar/fullcalendar.js"></script>


<script type="text/javascript">
	$(function () {
			// top bar active
	$('#navDashboard').addClass('active');

      //Date for the calendar events (dummy data)
      var date = new Date();
      var d = date.getDate(),
      m = date.getMonth(),
      y = date.getFullYear();

      $('#calendar').fullCalendar({
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
        events: [<?php echo $aux; ?>],
		eventColor: '#819481',
        header: {
          left: '',
          center: 'title'
        },
        buttonText: {
          today: 'today',
          month: 'month'          
        }        
      });


    });
</script>

<style>

.panel-body {
    padding: 25px;
}
		
	#wrap {
		width: 1100px;
		margin: 0 auto;
		}
		
	#external-events {
		float: left;
		width: 150px;
		padding: 0 10px;
		text-align: left;
		}
		
	#external-events h4 {
		font-size: 16px;
		margin-top: 0;
		padding-top: 1em;
		}
		
	.external-event { /* try to mimick the look of a real event */
		margin: 10px 0;
		padding: 2px 4px;
		background: #3366CC;
		color: #fff;
		font-size: .85em;
		cursor: pointer;
		}
		
	#external-events p {
		margin: 1.5em 0;
		font-size: 11px;
		color: #666;
		}
		
	#external-events p input {
		margin: 0;
		vertical-align: middle;
		}

	#calendar {
/* 		float: right; */
        margin: 10 auto;
		background-color: #FFFFFF;
		  border-radius: 6px;
        box-shadow: 0 1px 2px #C3C3C3;
		-webkit-box-shadow: 0px 0px 21px 2px rgba(0,0,0,0.18);
-moz-box-shadow: 0px 0px 21px 2px rgba(0,0,0,0.18);
box-shadow: 0px 0px 21px 2px rgba(0,0,0,0.18);
padding-left: 1em;
    padding-right: 1em;
    padding-bottom: 1em;
		}


.credito_publicado {
		background-color: #027093 !important;
		border-color: #027093 !important;
	}
	.ui-datepicker-calendar {
		display: none;
	}
	.badge {
		background-color: rgba(0, 0, 0, 0.25) !important;
	}
	.fc-view, .fc-view>table {
		background-color: #FFF !important;
	}
	.fc-view, .fc-view>table>thead {
		background-color: #DDD !important;
	}

	.fc-toolbar {
    text-align: center;
    margin-bottom: 1em;
    padding-top: 1em;
    padding-right: 1em;
}


</style>

<?php require_once 'includes/footer.php'; ?>
<?php }else{ echo "<script> alert('Su usuario no posee los permisos para entrar en esta vista, usted sera redireccionado.'); window.location.href = 'index.php' </script>";} ?>