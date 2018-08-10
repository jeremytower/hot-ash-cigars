<?php session_start();
$productId = $_GET['productId'];
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
   nav li a:hover{
   color: black;
   }
  </style>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="jquery.validate.js" type="text/javascript"></script>
	<script src="external.js"></script>
  </head>
<?php include('header.php');
	 $addAmountErr = "";
?>
  <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
  	$productId = test_input($_POST['productId']);
  	$productName = test_input($_POST['productName']);
  	$productPrice = test_input($_POST['productPrice']);
  	$productQuantity = test_input($_POST['productQuantity']);
  	$addAmount = test_input($_POST['addAmount']);
  	
  	if ($addAmount <= $productQuantity){
  		if(!isset($_COOKIE[$productId])){setcookie($productId, $addAmount, time() + (86400 * 30), "/");
  			$amountInCart = $addAmount;}
  		else
  		{
  			if($addAmount + $_COOKIE[$productId] <= $productQuantity) {
  				$amountInCart = $_COOKIE[$productId] + $addAmount;
  				setcookie($productId, $amountInCart, time() + (86400 * 30), "/");
  			}
  			else {echo "too much";}
  		
  		}
  			
  		header('Location: shop.php');
  		exit();
  		
  	}
  	
  	else {
  		$addAmountErr = "may not add more than what is currently in stock";
  	}

}

?>
<?php function test_input($data){
 $data = trim($data);
 $data = stripslashes($data);
 $data = htmlspecialchars($data);
 return $data;
 }?>

<?php 
	
		if(!isset($productId)) {$productId = $_GET['productId'];}

 $sql = "select * from products where productId = '$productId'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) == 1) {
		while($row = mysqli_fetch_assoc($result)) {
			$productId = $row['productId'];
			$productName = $row['productName'];
			$productDesc = $row['productDesc'];
			$productPrice = $row['productPrice'];
			$productQuantity = $row['productQuantity'];
			$imgPath = $row['imagePath'];
			$productLeft = $productQuantity - $_COOKIE[$productId];
			
		}
	}	
	?>
 
  <div id="product">
  <h2 id = "productName" style="margin-bottom: 50px;"><?php echo $productName;?></h2>
  <?php if($imgPath != 'productImages'){echo
  '<img src="'. $imgPath . '" id="productImage" alt="'.$productName.'" height="250" width="250">';
  }?>
  <p id="productDesc"><?php echo $productDesc;?></p>
  <p id="productPrice">$<?php echo $productPrice;?>.00/box</p>
 	<p><form id="cartForm" method="post" action="<?php echo($_SERVER["PHP_SELF"]);?>">
 	<input type="hidden" id="productId" name="productId" value="<?php echo $productId;?>">
 	<input type="hidden" id="productPrice" name="productPrice" value="<?php echo $productPrice;?>">
 	<input type="hidden" id="productName" name="productName" value="<?php echo $productName;?>">
 	Boxes In Stock: <input type="text" readonly="true" id="productQuantity" name="productQuantity" value = "<?php echo $productQuantity;?>"><br>
 	Boxes In Cart: <input type="text" readonly="true" id="productInCart" name="productInCart" value = "<?php echo $_COOKIE[$productId];?>"><br>
 	Add to Cart: <input type="number" name="addAmount" id="addAmount" value="1" min="1" max="<?php echo ($productQuantity - $_COOKIE[$productId]);?>"> <?php echo $addAmountErr;?>
 	<br><br><input type="submit" id="submit">
 	</form></p>
	
 </div>
 <?php include('footer.php');?>