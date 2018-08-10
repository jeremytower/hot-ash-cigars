<?php ini_set('mysql.connect_timeout',300);
ini_set('default_socket_timeout',300);
?>

<html>
	<body>
		<form method="post" enctype="multipart/form-data">
		<br/>
		<input type="file" name="image">
		<br/><br/>
		<input type="submit" name="sumit" value="upload"/>
		
		</form>
		<?php
		if(isset($_POST['sumit']))
		{
			if(getimagesize($_FILES['image']['tmp_name'] == FALSE))
			{
				echo "select a file";
			}
			else
			{
				$image = addslashes($_FILES['image']['tmp_name']);
				$name = addslashes($_FILES['image']['name']);
				$image = file_get_contents($image);
				$image = base64_encode($image);
				saveimage($name,$image);
			}
		}
		displayimage();
		function saveimage($name,$image)
		{
			$servername ="localhost";
			$username ="tower476_all";
			$password ="March123";
			$dbname ="tower476_cigar";
			
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			$qry = "insert into image (name, image) values ('$name', '$image')";
			$result=mysqli_query($conn,$qry);
			if($result)
			{
				echo "<br/> image uploaded";
			}	
			else
			{
				echo "<br/> image not uploaded";
			}
			
			
		}
		function displayimage()
		{
			$servername ="localhost";
			$username ="tower476_all";
			$password ="March123";
			$dbname ="tower476_cigar";
			
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			
			$qry = "select * from image";
			$result=mysqli_query($conn,$qry);
			while($row = mysqli_fetch_array($result))
			{
				echo '<img height="100" width="100" src="data:image;base64,'.$row[2].' "> ';
			}
			mysqli_close($conn);
		}
		?>
	</body>
</html>