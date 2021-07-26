<?php

$server = "localhost";
$user = "root";
$pass = "";
$database = "BMSEvent";
$conn = mysqli_connect($server, $user, $pass, $database);

if(!$conn) {
	echo "<script>alert('Conncetion failed.')</script>";
}

?>