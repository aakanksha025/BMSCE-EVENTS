<?php

$_server = "localhost";
$username = "root";
$password = "";
$database = "BMSEvent";

$conn = mysqli_connect($_server, $username, $password, $database);

if(!$conn) {
    die("<script>alert('Connection Failed.')</script>");
}

?>