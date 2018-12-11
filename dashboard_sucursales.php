<?php require_once 'includes/header.php'; ?>
<?php include ("notification.php"); ?>  
<?php if ($_SESSION['rol'] == 2) { ?>

<?php 

$sql_creditos = "SELECT o.order_id as id, o.order_date as fecha FROM orders o INNER JOIN sucursales s ON s.sucursales_id = o.client_name WHERE o.order_status = 1 AND o.client_name = ".$_SESSION['sucursales_id'];

$query_creditos = $connect->query($sql_creditos);
$aux = "";
while ($rows_creditos = $query_creditos->fetch_assoc()) {

	$aux .= "{id: '".$rows_creditos['id']."', title: 'Vencimiento de créditos', url: 'orders_sucursales.php?&id=".$rows_creditos['id']."', start: '".$rows_creditos['fecha']."', className: 'credito_publicado'},";

}

$connect->close();

?>


<style type="text/css">
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
</style>

<!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.print.css" media="print">


<div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-10">
		<div class="panel" style="background-color: #F4F4F4">
			<div class="panel-heading" style="background-color: #E3E2E0"> <i class="glyphicon"></i></div>
			<div class="panel-body">
				<div id="calendar"></div>
			</div>	
		</div>
		
	</div>
	<div class="col-md-1"></div>	
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

<?php require_once 'includes/footer.php'; ?>
<?php }else{ echo "<script> alert('Su usuario no posee los permisos para entrar en esta vista, usted sera redireccionado.'); window.location.href = 'index.php' </script>";} ?>