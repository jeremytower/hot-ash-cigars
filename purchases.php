<?php session_start();
 include('connect-db.php');?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Hot Ash Cigars</title>
  <link rel="stylesheet" href="stylesheet.css" type="text/css">
  <style type="text/css">
   nav li:nth-child(3){
   	background-color: yellow;
   	
   }
  </style>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="jquery.validate.js" type="text/javascript"></script>
	<script src="external.js"></script>
  </head>
<?php include('header.php');?>

  <div id="purchases">
  <?php
  $accountId = $_SESSION['accountId'];
$sql = "SELECT * FROM purchases WHERE accountId = '$accountId';";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
	
	while($row = mysqli_fetch_assoc($result)) { 
		
		echo "<div class='purchase'><b>Items Bought</b><br> ". $row['products'] . "<br><b>Purchase Total:</b> $". $row['price'].".00 </div>";
}
	
	}
		
	

else {
	echo "no past purchases currently in database";
}
 ?>
 </div>
 <?php include('footer.php');?>