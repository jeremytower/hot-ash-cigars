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
#nameErr {color: red;
	font-size: 11px;
	margin-top: 40px;
	margin-bottom: 0;
	display: inline-block;}
#productName {display: inline-block;}

  </style>
  </head>
<?php include('header.php');
$errors = $productNameErr = "";?>

<?php if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$productName = test_input($_POST["productName"]);
	$oldName = test_input($_POST["oldName"]);
	$productDesc = test_input($_POST["productDesc"]);
	$productId = test_input($_POST["productId"]);
	$productPrice = test_input($_POST["productPrice"]);
	$rerun = true;	
	$productQuantity = test_input($_POST["productQuantity"]);
	$productId = test_input($_POST["productId"]);	
	/*make sure name is open*/
	if($oldName != $productName){
	$sql = "select productName from products where productName = '$productName'";
		$result = mysqli_query($conn, $sql);
		 if (mysqli_num_rows($result) > 0) {$productNameErr= "product name already in use, choose another.";
		 	
		 }
	}
	
	if ($productName && $productDesc && $productPrice && $productQuantity != "" && $productNameErr == ""){
	
	
		$update = "update products SET productName = '$productName', productDesc = '$productDesc', productPrice = '$productPrice', 
		productQuantity = '$productQuantity' WHERE productId = '$productId'";
		
		if(mysqli_query($conn, $update)) {
			header('location: shop.php');
			exit();
			}
			else{
			echo "Error: "  . $sql . "<br>" . mysqli_error($conn);}
		}
		
}
  function test_input($data){
 $data = trim($data);
 $data = stripslashes($data);
 $data = htmlspecialchars($data);
 return $data;
 }
	
?>
  
<?php if(!isset($productId)) {$productId = $_GET['productId'];}
if($rerun != true){
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
			
		}
		}?>	  
  
  
  <h2 class="logo">Update Product Info</h2>
  
 <form method="post" id="add" action="<?php echo($_SERVER["PHP_SELF"]);?>">
				<input type="hidden" name="productId" id="productId" value="<?php echo $productId;?>">
				<input type="hidden" name="oldName" id="oldName" value="<?php echo $productName;?>">
				*Product Name:
				<input type= "text" name="productName" id="productName" value="<?php if(isset($productName)){echo $productName;}?>">
				<div id="nameErr"><?php echo $productNameErr;?></div>
				<br>
				
				*Product Description: 
				<input type="text" name="productDesc" id="productDesc" value="<?php if(isset($productDesc)){echo $productDesc;}?>" >
				<br>
				
				*Product Price: 
				<input type="text" name="productPrice" id="productPrice" value="<?php if(isset($productPrice)){echo $productPrice;}?>">
				<br>
				
				*Product Stock: 
				<input type="text" name="productQuantity" id="productQuantity"value="<?php if(isset($productQuantity)){echo $productQuantity;}?>">
				<br>
				
		
					
				<input type="submit" name="submit" id="submit" value="Submit">
				</form>
				
				
				
	
  
  
  
 <?php include('footer.php');?>