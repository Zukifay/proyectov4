<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "login_register_db";

$conn = mysqli_connect($host, $username, $password, $dbname);

if(!$conn){

    die("falla en la conexion: " . mysqli_connect_error());
}

?>