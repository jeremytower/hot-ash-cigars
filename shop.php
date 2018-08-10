<?php session_start();
 include('connect-db.php');?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Hot Ash Cigars</title>
  <link rel="stylesheet" href="stylesheet.css" type="text/css">
  <style type="text/css">
   nav li:nth-child(2){
   	background-color: yellow;
   	
   }
  </style>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="jquery.validate.js" type="text/javascript"></script>
	<script src="external.js"></script>
  </head>
<?php include('header.php');?>

  <div id="menu">
  <?php
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
	if ($_SESSION['admin']=="yes"){
	while($row = mysqli_fetch_assoc($result)) { 
	
		?>
		<div class='product'><div class="not_submit">
		
		<?php if($row['imagePath']!="productImages/") {echo '<img class="thumb" src="'.$row['imagePath']. '"><br>';} 
			else{echo '<img src="productImages/no_image.jpg">';} ?>
			
	 <h3 class='name'> <a href="product.php?productId=<?php echo $row["productId"];?>"><?php echo $row["productName"];?> </a></h3><div class='price'>$<?php echo 			
    		$row["productPrice"];?>/box</div><div class='quantity'><?php echo $row["productQuantity"];?> boxes in stock</div></div><br>
		
		<div class='stock' style="display: none;"><?php echo $row["productQuantity"];?></div>\<br>
		<a href="update.php?productId=<?php echo $row['productId'];?>">Update</a>
		<a href="delete.php?productId=<?php echo $row['productId'];?>">Delete</a>
		</div> <?php
		
		
}
	}
	
	else {
	while($row = mysqli_fetch_assoc($result)) { 
		?><div class='product'><div class='not_submit'>
		<?php if($row['imagePath']!="productImages/") {echo '<img  class="thumb" src="'.$row['imagePath']. '"><br>';} 
			else{echo '<img class="thumb" src="productImages/no_image.jpg">';} ?>
		 <h3 class='name'> <a href="product.php?productId=<?php echo $row["productId"];?>"><?php echo $row["productName"];?>
		  </a></h3><div class='price'>$<?php echo $row["productPrice"];?>/box</div><div class='quantity'><?php echo $row["productQuantity"];?> boxes in stock</div>
		</div><br>
		<div class='addToCartSubmit'><a href='product.php?productId=<?php echo $row["productId"];?>'>Add To Cart</a></div>
		
		</div> <?php
		
		
}
	
	}
	
	
	}	
	

else {
	echo "0 items currently in database";
}
 ?>
 </div>
 <?php include('footer.php');?>