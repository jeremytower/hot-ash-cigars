<?php session_start();
 include('connect-db.php');
 if ($_SESSION['admin'] != "yes"){header('location: index.php');}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Hot Ash Cigars</title>
  <link rel="stylesheet" href="stylesheet.css" type="text/css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="jquery.validate.js" type="text/javascript"></script>
	<script src="external.js"></script>
	 <style type="text/css">
    #add label.error {
  font-size: 13px;
  color: #F00;
  display: block;
	margin-left: 30px;
	margin-bottom: -80px;
	margin-top: -30px;
	padding-top: 0;
}



.phpErr {
	color: red;
	display: inline-block;
	font-size: 12px;
	margin-left: 30px;
}

  </style>
  </head>
<?php include('header.php');
$errors = "";?>

<?php if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$productName = test_input($_POST["productName"]);
		
	$productDesc = test_input($_POST["productDesc"]);
		
	$productPrice = test_input($_POST["productPrice"]);
		
	$productQuantity = test_input($_POST["productQuantity"]);
	$productId = test_input($_POST["productId"]);	
	
	
	
	

	
	
		$delete = "DELETE FROM products WHERE productId = '$productId'";
		
		if(mysqli_query($conn, $delete)) {
			header('location: shop.php');
			exit();
			}
			else{
			echo "Error: "  . $sql . "<br>" . mysqli_error($conn);}
		
		
}
  function test_input($data){
 $data = trim($data);
 $data = stripslashes($data);
 $data = htmlspecialchars($data);
 return $data;
 }
	
?>
  
<?php  $productId = $_GET['productId'];
	$sql = "select * from products where productId = '$productId';";
        $result = mysqli_query($conn, $sql);
       
		
		 if (mysqli_num_rows($result) == 1) {
		 		
			 while($row = mysqli_fetch_assoc($result)) {
		 		
				$productId = $row['productId'];
			$productName = $row['productName'];
			$productDesc = $row['productDesc'];
			$productPrice = $row['productPrice'];
			$productQuantity = $row['productQuantity'];
			
			}
			}
		else {
			echo "not logged in";
		}?>	  
  
  
  <h2 class="logo">Update Product Info</h2>
  
 <form method="post" id="add" action="<?php echo($_SERVER["PHP_SELF"]);?>">
				<input type="hidden" name="productId" id="productId"  value="<?php echo $productId;?>">
				*Product Name:
				<input type= "text" name="productName" id="productName" value="<?php if(isset($productName)){echo $productName;}?>" disabled>
				<br>
				
				*Product Description: 
				<input type="text" name="productDesc" id="productDesc" value="<?php if(isset($productDesc)){echo $productDesc;}?>" disabled>
				<br>
				
				*Product Price: 
				<input type="text" name="productPrice" id="productPrice" value="<?php if(isset($productPrice)){echo $productPrice;}?>"disabled>
				<br>
				
				*Product Stock: 
				<input type="text" name="productQuantity" id="productQuantity"value="<?php if(isset($productQuantity)){echo $productQuantity;}?>" disabled>
				<br>
				
		
					
				<input type="submit" name="submit" id="submit" value="Delete">
				</form>
				
				
				
	
  
  
  
 <?php include('footer.php');?>