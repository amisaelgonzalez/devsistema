<?php 
require_once 'config/db_connect.php';

session_start();

if(isset($_SESSION['userId'])) {
	switch ($_SESSION['rol']) {
		case '1':
			header('location: dashboard.php');
			break;
		case '2':
			header('location: dashboard_sucursales.php');
			break;
		case '3':
			header('location: stock.php');
			break;
		case '4':
			header('location: orders.php?o=manord');
			break;

		default:
			# code...
			break;
	}
}

$errors = array();

if($_POST) {		

	$username = $connect->real_escape_string($_POST['username']); // Escapando caracteres especiales

	//convertir en minuscula
	$username = strtolower($username);

	$password = $_POST['password'];

	if(empty($username) || empty($password)) {
		if($username == "") {
			$errors[] = "Se requiere nombre de usuario";
		} 

		if($password == "") {
			$errors[] = "Se requiere contraseña";
		}
	} else {
		$sql = "SELECT * FROM users WHERE username = '$username'";
		$result = $connect->query($sql);

		if($result->num_rows == 1) {
			$password = md5($password);
			// exists 
			$mainSql = "SELECT s.user_id as user_id, s.rol as rol, s.sucursales_id as sucursales_id, su.sucursales_status as sucursales_status FROM users s LEFT JOIN sucursales su ON s.sucursales_id = su.sucursales_id WHERE username = '$username' AND password = '$password'";
			$mainResult = $connect->query($mainSql);

			if($mainResult->num_rows == 1) {
				$value = $mainResult->fetch_assoc();
				if ($value['rol'] == 2) {
					if ($value['sucursales_status'] != 1) {
						$login = false;
					}else{
						$login = true;
					}
				}else{
					$login = true;
				}

				if ($login == true) {
					$user_id = $value['user_id'];
	                $rol     = $value['rol'];
	                $sucursal= $value['sucursales_id'];
	              
	                // set session
	                $_SESSION['userId'] = $user_id;
	                $_SESSION['rol']    = $rol;
	                $_SESSION['sucursales_id'] = $sucursal;
	                if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 4) {
						header('location: dashboard.php');
	                }elseif ($_SESSION['rol'] == 3) {
	                	header('location: stock.php');
	                }
				}else{
					$errors[] = "La sucursal que administra ha sido eliminada";
				}

			} else{
				
				$errors[] = "Combinación incorrecta de nombre de usuario y/o contraseña";
			} // /else
		} else {		
			$errors[] = "El nombre de usuario no existe";		
		} // /else
	} // /else not empty username // password
	
} // /if $_POST
?>

<!DOCTYPE html>
<html>
<head>
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

  <!-- jquery -->
	<script src="assests/jquery/jquery.min.js"></script>
  <!-- jquery ui -->  
  <link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
  <script src="assests/jquery-ui/jquery-ui.min.js"></script>

  <!-- bootstrap js -->
	<script src="assests/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row vertical">


		<div class="titulo">Bienvenido de nuevo</div>	
		<div class="head-subitle">A continuación ingresa tus datos de acceso</div>

	<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="loginForm">


  <div class="group">

    <input type="text" id="username" name="username" ><span class="highlight"></span><span class="bar"></span>
    <label for="username">Usuario</label>
  </div>
  <div class="group">
    <input type="password" id="password" name="password" ><span class="highlight"></span><span class="bar"></span>
    <label for="password">Contraseña</label>
  </div>
  <button type="submit" class="button buttonBlue">INGRESAR
  </button>
</form>

<style type="text/css">
	* { box-sizing:border-box; }


.titulo {
  color: #000;
  font-size: 34px;
  font-weight: normal;
  padding: 10px 0;
  text-align: center;
  text-transform: uppercase;
  text-align: center;
  margin-bottom: 0px;
}

.head-subitle {
  color: #81BEF7;
  font-size: 20px;
  font-weight: normal;
  padding: 0px 0;
  text-align: center;
  text-transform: uppercase;
  text-align: center;
  margin-bottom: 0px;
}


hgroup { 
	text-align:center;
	margin-top: 4em;
}

h1, h3 { font-weight: 300; }

h1 { color: #636363; }

h3 { color: #4a89dc; }

form {
	width: 380px;
	margin: 4em auto;
	padding: 3em 2em 2em 2em;
	background: #fafafa;
	border: 1px solid #ebebeb;
	box-shadow: rgba(0,0,0,0.14902) 0px 1px 1px 0px,rgba(0,0,0,0.09804) 0px 1px 2px 0px;
}

.group { 
	position: relative; 
	margin-bottom: 45px; 
}

input {
	font-size: 18px;
	padding: 10px 10px 10px 5px;
	-webkit-appearance: none;
	display: block;
	background: #fafafa;
	color: #636363;
	width: 100%;
	border: none;
	border-radius: 0;
	border-bottom: 1px solid #757575;
}

input:focus { outline: none; }


/* Label */

label {
	color: #999; 
	font-size: 18px;
	font-weight: normal;
	position: absolute;
	pointer-events: none;
	left: 5px;
	top: 10px;
	transition: all 0.2s ease;
}


/* active */

input:focus ~ label, input.used ~ label {
	top: -20px;
  transform: scale(.75); left: -2px;
	/* font-size: 14px; */
	color: #4a89dc;
}


/* Underline */

.bar {
	position: relative;
	display: block;
	width: 100%;
}

.bar:before, .bar:after {
	content: '';
	height: 2px; 
	width: 0;
	bottom: 1px; 
	position: absolute;
	background: #4a89dc; 
	transition: all 0.2s ease;
}

.bar:before { left: 50%; }

.bar:after { right: 50%; }


/* active */

input:focus ~ .bar:before, input:focus ~ .bar:after { width: 50%; }


/* Highlight */

.highlight {
	position: absolute;
	height: 60%; 
	width: 100px; 
	top: 25%; 
	left: 0;
	pointer-events: none;
	opacity: 0.5;
}


/* active */

input:focus ~ .highlight {
	animation: inputHighlighter 0.3s ease;
}


/* Animations */

@keyframes inputHighlighter {
	from { background: #4a89dc; }
	to 	{ width: 0; background: transparent; }
}


/* Button */

.button {
  position: relative;
  display: inline-block;
  padding: 12px 24px;
  margin: .3em 0 1em 0;
  width: 100%;
  vertical-align: middle;
  color: #fff;
  font-size: 16px;
  line-height: 20px;
  -webkit-font-smoothing: antialiased;
  text-align: center;
  letter-spacing: 1px;
  background: transparent;
  border: 0;
  border-bottom: 2px solid #3160B6;
  cursor: pointer;
  transition: all 0.15s ease;
}
.button:focus { outline: 0; }


/* Button modifiers */

.buttonBlue {
  background: #4a89dc;
  text-shadow: 1px 1px 0 rgba(39, 110, 204, .5);
}

.buttonBlue:hover { background: #357bd8; }


/* Ripples container */

.ripples {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
  background: transparent;
}


/* Ripples circle */

.ripplesCircle {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  opacity: 0;
  width: 0;
  height: 0;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.25);
}

.ripples.is-active .ripplesCircle {
  animation: ripples .4s ease-in;
}


/* Ripples animation */

@keyframes ripples {
  0% { opacity: 0; }

  25% { opacity: 1; }

  100% {
    width: 200%;
    padding-bottom: 200%;
    opacity: 0;
  }
}


</style>

<script type="text/javascript">$(window, document, undefined).ready(function() {

  $('input').blur(function() {
    var $this = $(this);
    if ($this.val())
      $this.addClass('used');
    else
      $this.removeClass('used');
  });

  var $ripples = $('.ripples');

  $ripples.on('click.Ripples', function(e) {

    var $this = $(this);
    var $offset = $this.parent().offset();
    var $circle = $this.find('.ripplesCircle');

    var x = e.pageX - $offset.left;
    var y = e.pageY - $offset.top;

    $circle.css({
      top: y + 'px',
      left: x + 'px'
    });

    $this.addClass('is-active');

  });

  $ripples.on('animationend webkitAnimationEnd mozAnimationEnd oanimationend MSAnimationEnd', function(e) {
  	$(this).removeClass('is-active');
  });

});</script>


		</div>
		<!-- /row -->
	</div>
	<!-- container -->	
</body>
</html>







	