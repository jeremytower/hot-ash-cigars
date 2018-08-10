<?php session_start();
 include('connect-db.php');
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
    #user label.error {
  font-size: 13px;
  color: #F00;
  display: block;
	margin-bottom: -60px;
	margin-top: -30px;
	padding-bottom: 0;
	margin-left: 30px;
}

#header_nav a:nth-child(1){
	text-decoration: underline;
}

     nav li:hover {
   background-color: yellow;
   }
      nav li a:hover{
   color: black;
   }

.error {
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
	
	$username = test_input($_POST["username"]);
	$password = test_input($_POST["password"]);
	$login = "select * from account where username='$username' and password = '$password';";
        $result = mysqli_query($conn, $login);
		
		 if (mysqli_num_rows($result) == 1) {
		 		
			 while($row = mysqli_fetch_assoc($result)) {
		 		
			  $_SESSION['loggedIn'] = 1;
			  $_SESSION['firstName'] = $row['s_firstName'];
			  $_SESSION['accountId'] = $row['accountId'];
			  $_SESSION['admin'] = $row['admin'];
			  header("location: index.php");
			  exit();
		
		}	  
		
	  
		 }
		else {
			$errors = "*incorrect username or password";
		}
}
  function test_input($data){
 $data = trim($data);
 $data = stripslashes($data);
 $data = htmlspecialchars($data);
 return $data;
 }
	
?>
  
  <h2 class="logo">Log In</h2>
  
  <form method="post" id="user" action="<?php echo($_SERVER["PHP_SELF"]);?>">
				<h2 class="form_header">Login Information</h2><br>
				*Username:
				<input type= "text" name="username" id="username"><div class="error"><?php echo $errors?></div>
				<br>
				
				
				*Password: 
				<input type="password" name="password" id="password">
				<br>
				<input type="submit" id="submit" name="submit">
				</form>
				
				
	
  
  
  
 <?php include('footer.php');?>