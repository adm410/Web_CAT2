<?php
// Connect to database server
$server="localhost";
$serveraccount="root";
$serverpassword="";

// Establish a connection
// Functions for connection:1.MySQLi
$connect=mysqli_connect($server,$serveraccount,$serverpassword);
// Check if everything is okay
if ($connect){
	echo "Server connected successfully";
}else {
	die(mysqli_connect_error($connect));
}

// Create a query
$query = "CREATE DATABASE cat2";
// Execute query
$execute = mysqli_query($connect, $query);
// Check if successfully executed
if($execute) {
	echo "<br>db Created successfully";
}else{
	die(mysqli_error($connect));
}

?>