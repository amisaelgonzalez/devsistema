<?php 	

$localhost = "localhost";
//$username = "cnicebou_sistema";
$username = "root";
//$password = "s=Y1SAuSFVR3";
$password = "";
$dbname = "cnicebou_sistema";
/*

$username = "cnicebou_devsistema";
$password = "?8}O1[1YQwon";
$dbname = "cnicebou_devsistema";
*/
// db connection
$connect = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  // echo "Successfully connected";
}

?>