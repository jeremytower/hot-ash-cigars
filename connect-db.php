<?php

$servername ="localhost";
$username ="root";
$password ="March123";
$dbname ="cigar";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn){
	die("connection failed: " . mysqli_connect_error());
}
?>