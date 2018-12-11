<?php

//if ($_SESSION['USUARIO'] == '')	header ("Location: index.php");
require_once 'config/core.php';

$query_notif = "";
if ($_SESSION['rol'] == 1) {
	$query_notif = mysqli_query ($connect, "SELECT n.notifications_id, n.orders_id as TEXT, n.notifications_date as CREATED, n.sucursales_id, s.sucursales_name FROM notifications n INNER JOIN sucursales s ON s.sucursales_id = n.sucursales_id ORDER BY n.notifications_date DESC");
}elseif ($_SESSION['rol'] == 2) {
	$userId = $_SESSION['userId'];
	$query_notif = mysqli_query ($connect, "SELECT n.notifications_id, n.orders_id as TEXT, n.notifications_date as CREATED, n.sucursales_id, s.sucursales_name FROM notifications n INNER JOIN sucursales s ON s.sucursales_id = n.sucursales_id INNER JOIN users u ON u.sucursales_id = n.sucursales_id WHERE u.user_id = '$userId' ORDER BY n.notifications_date DESC");
}
/*
	$query_notif = mysqli_query ($connect, "SELECT o.order_id as TEXT, o.order_date as CREATED, s.sucursales_name, o.client_contact, o.payment_status FROM orders o INNER JOIN sucursales s ON s.sucursales_id = o.client_name WHERE o.order_status = 1");
*/
if ($query_notif != "") {
	$res = [];
	$msjs= "";
	if(mysqli_num_rows($query_notif) > 0) { 
		while($rows_notif = mysqli_fetch_assoc($query_notif)){
			$res[] = array(
		        "CREATED"=> $rows_notif['CREATED'],
		        "TEXT"   => $rows_notif['TEXT']
		    );
		}
	} // if num_rows
	else{
		$msjs= "No tienes ninguna notificación";
	}

?>
<style type="text/css">
/*====== Area de notificacion*/
.full-width{
	margin: 0;
	padding: 0;
	width: 100%;
	box-sizing: border-box;
}

#leftCol {
    overflow-y: scroll;
	width: 317px;
}

.container-notifications{
    position: fixed;
	height: 100%;
	top: 0;
	left: 0;
	pointer-events: none;
	opacity: 0;
	z-index: 1001;
}
.container-notifications-bg{
	height: 100%;
	position: absolute;
	top: 0;
	left: 0;
	background-color: rgba(0,0,0,.5);
}
.container-notifications-show{
	pointer-events: auto;
	opacity: 1;
}
.NotificationArea{
	box-sizing: border-box;
    background-color: #fff;
    height: 100%;
    width: 300px;
    top: 0;
    z-index: 999;
    right: -300px;
    transition: all .3s ease-in-out;
    position: absolute;
}
.NotificationArea-title{
	font-size: 21px;
    height: 45px;
    line-height: 45px;
    color: #fff;
    background-color: #666;
    box-sizing: border-box;
}
.NotificationArea-title i{
    position: absolute;
    top: 0;
    right: 0;
    height: 45px;
    width: 45px;
    line-height: 45px;
    font-size: 25px;
    cursor: pointer;
}
.Notification,
.Notification-icon,
.Notification-text{
    margin: 0;
    padding: 0;
    height: 80px;
    box-sizing: border-box;
}
.Notification{
    position: relative;
    display: block;
    width: 300px;
    border-top: 1px solid #f3f3f3;
    color: #2b2b2c;
    font-size: 13px;
    transition: all .3s ease-in-out;
}
.Notification:hover{
	background-color: rgba(0,0,0,.07);
}
.Notification small{
    color: #BDBDBD;
}
.Notification-icon,
.Notification-text{
    position: absolute;
    top: 0;
}
.Notification-icon{
    width: 60px;
    left: 0;
    box-sizing: border-box;
}
.Notification-icon span{
    height: 40px;
    width: 40px;
    line-height: 40px;
    margin-left: 10px;
    margin-top: 15px;
    text-align: center;
    font-size: 18px;
    color: #fff;
    background-color: #337ab7;
    border-radius: 50%;
}
.Notification-text{
    width: 235px;
    right: 0;
}
.Notification-text p{
	position: absolute;
	width: 100%;
	top: 50%;
	left: 0;
	transform: translateY(-50%);
}
.NotificationArea-show{
    right: 0;
}
</style>
<section class="full-width container-notifications">		
	<div class="full-width container-notifications-bg btn-Notification"></div>	    
	<section class="NotificationArea" id="leftCol">	        
		<div class="full-width text-center NotificationArea-title">Notificaciones<i class="btn-Notification">&times;</i></div>	        
		<?php foreach ($res as $imprimir) { ?>
		<a href="#" class="Notification">	    
			<?php 
			
			?>
			<div class="Notification-icon"><span class="glyphicon glyphicon-time"></span></div>	          
			<div class="Notification-text">	                
				<p>	                    
					<i><span class="glyphicon glyphicon-triangle-right"></span></i>	 
					<?php 
					$result = "El crédito con número de orden #".$imprimir['TEXT']." llego a su fecha de vencimiento: ";

					$date1 = new DateTime($imprimir['CREATED']);
					$fecha = $date1->format('d-m-Y');

					$date2 = new DateTime($imprimir['CREATED']);
					$hora = $date2->format('H:i');

					?>
					<strong><?php echo $result; ?></strong> 	                   
					<br>	                   
					<small><?php echo "El ".$fecha?></small>	                
				</p>	            
			</div>	
		</a>
		<?php } 
		if ($msjs != ""){
			echo "<center><h5>".$msjs."</h5></center>";
		} ?>
	</section>
</section>
<?php 
}
?>