<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>title</title>
  </head>
  <body>
  
  
  <?php if ($_SERVER["REQUEST_METHOD"] == "POST"){
	  if(isset($_FILES['file'])){
		  $file = $_FILES['file'];
		  
		  
		  $file_name = $file['name'];
		  $file_tmp = $file['tmp_name'];
		  $file_size = $file['size'];
		  $file_error = $file['error'];
		  $file_ext = explode('.', $file_name);
		  $file_ext = strtolower(end($file_ext));
		  $allowed = array('jpg', 'txt');
		  if(in_array($file_ext, $allowed)){
			  if($file_error === 0){
				  if($file_size <= 2097152){
					  $file_destination = 'uploads/'.$file_name;
					  if(move_uploaded_file($file_tmp, $file_destination)){
						  echo "right!";
					  }
					  else {echo "fuck";}
				  }
			  }
		  }
		  
		  
		  echo "<br>";
		  
	  }
	  
  }
  ?>
  
  
	<form method="post" action="<?php echo($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
		<br/>
		<input type="file" name="file">
		<br/><br/>
		<input type="submit" name="sumit" value="upload"/>
		
		</form>
  </body>
</html>