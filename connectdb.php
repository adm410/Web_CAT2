<?php
//connect to groupbmar database
$server="localhost";
$serveraccount="root";
$serverpassword="";
$db="cat2";

$connect = mysqli_connect($server,$serveraccount,$serverpassword,$db);
// Check if not connected
if (!$connect) {
	die(mysqli_connect_error($connect));
}
?>