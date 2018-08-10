<?php session_start();
 include('connect-db.php');
 if ($_SESSION['admin'] != "yes"){header('location: index.php');}?>
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
	margin-bottom: -60px;
	margin-top: -30px;
	padding-bottom: 0;
	margin-left: 30px;
}

   <?php echo '#header_nav a:nth-child(1){
	text-decoration: underline
}';?>
#nameErr {color: red;
	font-size: 11px;
	margin-top: 40px;
	margin-bottom: 0;
	display: inline-block;}
#productName {display: inline-block;}
  </style>

  </head>
<?php include('header.php');?>

<h2 class="logo">Add Cigar Products</h2>

<?php $productId = $productName = $productDesc = $productPrice = $productQuantity = $forgot = $productNameErr = "";?>
	<?php
	
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
		/*$image = addslashes($_FILES['image']['tmp_name']);
		$image = file_get_contents($image);
		$image = base64_encode($image);*/
		
		
		
		$productName = test_input($_POST["productName"]);
		
		$productDesc = test_input($_POST["productDesc"]);
		
		$productPrice = test_input($_POST["productPrice"]);
		
		$productQuantity = test_input($_POST["productQuantity"]);
		
		/*make sure the name isn't already taken*/
		$sql = "select productName from products where productName = '$productName'";
		$result = mysqli_query($conn, $sql);
		 if (mysqli_num_rows($result) > 0) {$productNameErr= "product name already in use, choose another.";
		 	
		 }
		
	
	if ($productName && $productDesc && $productPrice && $productQuantity != "" && $productNameErr == ""){
	 $file = $_FILES['image'];
	
		 $img_name = $file['name'];
			  $img_tmp = $file['tmp_name'];
			  $img_size = $file['size'];
			  $img_error = $file['error'];
			  $img_ext = explode('.', $img_name);
			  $img_ext = strtolower(end($img_ext));
			  $allowed = array('jpg', 'png');
			  $img_name = $productName .'.' . $img_ext;
			  echo "<h1> Extension: " . $img_ext . "</h1>";
			 if($img_ext == 'jpg' or $img_ext == 'png'){ $img_path = 'productImages/'.$img_name;} 
			 else{$img_path = 'productImages/';}
			  
			  
		
		$sql = "INSERT INTO products (productName, productDesc, productPrice, productQuantity, imagePath)
		VALUES ('$productName', '$productDesc', '$productPrice', '$productQuantity', '$img_path');";
		if (mysqli_query($conn, $sql)) {
		
			
		
			 if(in_array($img_ext, $allowed)){
				 if($img_error === 0){
					if($img_size <= 5097152){
						 
						  if(move_uploaded_file($img_tmp, $img_path)){
							 header('location: index.php');
						  }
						  
					  }
				  }
		  	    }
		
		}
			
		else {
			echo "Error: "  . $sql . "<br>" . mysqli_error($conn);
		}
	
	
	

  }}
  
 
  function test_input($data){
 $data = trim($data);
 $data = stripslashes($data);
 $data = htmlspecialchars($data);
 return $data;
 }
  ?>


<form method="post" id="add" action="<?php echo($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
				
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
				<input type="file" name="image">
				<br>
		
					
				<input type="submit" name="submit" id="submit" value="Submit">
				</form>



<?php include('footer.php');?>
