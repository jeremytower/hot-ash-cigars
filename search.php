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
  
  $keyword = $_POST['search'];
$sql = "SELECT * FROM products WHERE productName LIKE '%" . $keyword . "%' or productDesc LIKE '%" . $keyword . "%';";


$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
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
	
	
		
	

else {
	echo "search returned 0 results";
}
 ?>
 </div>
 <?php include('footer.php');?>