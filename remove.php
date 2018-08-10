<?php session_start;
$productId = $_GET['productId'];
if($productId != ""){
	if(isset($_COOKIE[$productId])){setcookie($productId, 0, time() + (8), "/");}
	header('location: cart.php');
}