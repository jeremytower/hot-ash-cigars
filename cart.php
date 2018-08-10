<?php session_start();
 include('connect-db.php');?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Hot Ash Cigars</title>
  <link rel="stylesheet" href="stylesheet.css" type="text/css">
  <style type="text/css">
     nav li:hover {
   background-color: yellow;
   }
   <?php if($_SESSION['loggedIn']==1 &&  $_SESSION['admin'] == 'yes'){
  echo '#header_nav a:nth-child(2){
	text-decoration: underline
}';}

else if($_SESSION['loggedIn']==1 &&  $_SESSION['admin'] == ''){
  echo '#header_nav a:nth-child(1){
	text-decoration: underline
}';}
else {echo      ' #header_nav a:nth-child(3){
	text-decoration: underline}';
}?>
      nav li a:hover{
   color: black;
   }
      nav li a:hover{
   color: black;
   }
  </style>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="jquery.validate.js" type="text/javascript"></script>
	<script src="external.js"></script>
  </head>
<?php include('header.php');
$cartItemsId = array();
$cartItemsNum = array();
$grandTotal = 0;?>


 <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
 	if ($_SESSION['loggedIn'] != 1){
 		header('location: login.php');
 		exit();
 		
 	}
 	$account_Id = $_SESSION['accountId'];
 	$grandTotal = test_input($_POST['grandTotal']);
  	$numItems = test_input($_POST['numItems']);
  	echo $numItems;
  	$ids = array();
  
 
  	for ($x = 0; $x < $numItems; $x++)  {
  	$productId = test_input($_POST[$x]);
  	echo $productId;
  		array_push($ids, $productId);
  		
  	}
  	$purchaseList = "";
  	foreach($ids as $id){
	  	$numBought = $_COOKIE[$id];
	  	 $sql = "select * from products where productId = '$id'";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) == 1) {
			while($row = mysqli_fetch_assoc($result)) {
	  		$inStock = $row['productQuantity'];
	  		  $purchaseList = $purchaseList . $row['productName'] . '(' . $numBought . ') ';
	  	}
	  	}
	  	$newQuantity = $inStock - $numBought;
	  	$update = "update products SET productQuantity = '$newQuantity' WHERE productId = '$id'";
	  	if (!mysqli_query($conn, $update)) {echo "Error updating";}
	  	else {setcookie($id, 0, time() + (86400 * 30), "/");}
	  	
	  
		
	}
	
	$sql = "INSERT INTO purchases (accountId, products, price)
		VALUES ('$account_Id', '$purchaseList', '$grandTotal');";
		if (mysqli_query($conn, $sql)) {
	
		header('location: index.php');
		exit();
		}
		else{echo " didnt work";}
}
?>

<?php function test_input($data){
 $data = trim($data);
 $data = stripslashes($data);
 $data = htmlspecialchars($data);
 return $data;
 }?>
  <h2 class="logo" style="margin-bottom: 50px;">Shopping Cart</h2>
  <div id="cart">
  <?php
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
$cartEmpty=true;
if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) { 
		$productId = $row['productId'];
		if(isset($_COOKIE[$productId]) && $_COOKIE[$productId] > 0){
			$cartEmpty = false;
			$inCart = $_COOKIE[$productId];
			$price = $row['productPrice'];
			$total = $price * $inCart;
			echo "<br><div class='cartItem'><img class='cartImg' src='".$row['imagePath']."'width='100' height='100'>";
			echo "<div class='cartName'>". $row['productName'] . "</div>
			<div class='remove'><a href='remove.php?productId=". $productId . "'>x</a></div>
			<br>" . $inCart. " in cart x $" . $price . ".00 = $" . $total. ".00</div>"; 
			array_push($cartItemsId, $productId);
			array_push($cartItemsNum, $inCart);
			$grandTotal += $total;
		}
}
	}
	
	
	
		
	

else {
	echo "0 items currently in shopping cart";
}
 ?>
 
  <?php if($cartEmpty==false){ echo "<br><br>Total: $" . $grandTotal . ".00";}?>
 
 <form id="checkoutForm" method="post" action="<?php echo($_SERVER["PHP_SELF"]);?>">
 
 <?php
 	$numItems = count($cartItemsId);
 	for ($x = 0; $x < $numItems; $x++)  {
 		echo "<input type='hidden' id='" . $x. "' name='" . $x . "' value='" . $cartItemsId[$x] . "'><br>";
}
 ?>
 <input type="hidden" id="grandTotal" name="grandTotal" value = "<?php echo $grandTotal;?>">
 <input type="hidden" id="numItems" name="numItems" value = "<?php echo $numItems;?>">
 <br>
 <?php if($cartEmpty == false){echo '<input type = "submit" id="submit" value="Confirm Purchase" style="width: auto; margin: 40px;">';
 }
 else {
	echo "0 items currently in shopping cart<br><br>";
}?>
 </form>
 

 
 </div>
 <?php include('footer.php');?>