<?php include('connect-db.php');?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Hot Ash Cigars</title>
  <link rel="stylesheet" href="stylesheet.css" type="text/css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="jquery.validate.js" type="text/javascript"></script>
	<script src="external.js"></script>
	<script>
$(document).ready(function(){

});
	</script>
	 <style type="text/css">
    #user label.error {
  font-size: 13px;
  color: #F00;
  display: inline-block;

	padding-bottom: 0;
	margin-left: 30px;
}
#header_nav a:nth-child(2){
	text-decoration: underline;
}

      nav li:hover {
   background-color: yellow;
   }

      nav li a:hover{
   color: black;
   }
  

.phpErr {
	color: red;
	display: inline-block;
	font-size: 12px;
	margin-left: 30px;
}



  </style>
  </head>
<?php include('header.php');?>
<?php $emailTakenErr = $usernameTakenErr = $username = $password = "";?>
<?php $available = false;?>

<?php if ($_SERVER["REQUEST_METHOD"] == "POST" && $available == false){
	$emailTaken = true;
	$usernameTaken = true;
	$username = test_input($_POST["username"]);
	$email = test_input($_POST["email"]);
	$email = strtolower($email);
	$password = test_input($_POST["password"]);
	$s_firstName = test_input($_POST["s_firstName"]);
	$s_lastName = test_input($_POST["s_lastName"]);
	$s_address = test_input($_POST["s_address"]);
	$s_city = test_input($_POST["s_city"]);
	$s_state = test_input($_POST["s_state"]);
	$s_zip = test_input($_POST["s_zip"]);
	$b_firstName = test_input($_POST["b_firstName"]);
	$b_lastName = test_input($_POST["b_lastName"]);
	$b_address = test_input($_POST["b_address"]);
	$b_city = test_input($_POST["b_city"]);
	$b_state = test_input($_POST["b_state"]);
	$b_zip = test_input($_POST["b_zip"]);
	
	$sql = "SELECT username FROM account WHERE username = '$username';";
	$result = (mysqli_query($conn, $sql));
	if (mysqli_num_rows($result) > 0){
		$usernameTakenErr = "Sorry, username already taken.";
	}
	else {$usernameTaken = false;
			$usernameTakenErr = "";}
	
	$sql2 = "SELECT email FROM account WHERE email = '$email';";
	$result2 = (mysqli_query($conn, $sql2));
	if (mysqli_num_rows($result2) > 0){
		$emailTakenErr = "Sorry, email already taken.";
	}
	else {$emailTaken = false; $emailTakenErr = "";}
	
	if ($emailTaken == false && $usernameTaken == false){
		$available = true;
	}
	
}	?>


<?php if ($_SERVER["REQUEST_METHOD"] == "POST" && $available == true){
	
$sql = "INSERT INTO account (username, password, email, s_firstName, s_lastName, s_address, s_city, s_state, s_zip, b_firstName, 
	b_lastName, b_address, b_city, b_state, b_zip)VALUES ('$username', '$password', '$email', '$s_firstName', '$s_lastName', '$s_address', '$s_city', 
	'$s_state', '$s_zip', '$b_firstName', '$b_lastName', '$b_address', '$b_city', '$b_state', '$b_zip' );";
		if (mysqli_query($conn, $sql)) {
			printf("<script>location.href='login.php'</script>");
		}else {
			echo "Error: "  . $sql . "<br>" . mysqli_error($conn);
		}
	}

  
 
  function test_input($data){
 $data = trim($data);
 $data = stripslashes($data);
 $data = htmlspecialchars($data);
 return $data;
 }
	
?>
  
  <h2 class="logo">Create An Account</h2>
  
  <form method="post" id="user" action="<?php echo($_SERVER["PHP_SELF"]);?>">
				<h2 class="form_header">Login Information</h2><br>
				*Username:
				<input type= "text" name="username" id="username" value="<?php if(isset($username)){echo $username;}?>"><div class="phpErr"><?php echo $usernameTakenErr;?></div>
			<br>
				
				*Email: 
				<input type="text" name="email" id="email" value="<?php if(isset($email)){echo $email;}?>">	<div class="phpErr"><?php echo $emailTakenErr;?></div>
		<br>
				
				*Password: 
				<input type="password" name="password" id="password" value="<?php if(isset($password)){echo $password;}?>">
				<br>
				
				
				*Confirm Password: 
				<input type="password" name="confirmPassword" id="confirmPassword" value="<?php if(isset($password)){echo $password;}?>">
				<br>
				<h2 class="form_header">Shipping Information</h2><br>
				*First Name: 
				<input type="text" name="s_firstName" id="s_firstName" value = "<?php if(isset($s_firstName)) {echo $s_firstName;}?>">
				<br>
				
				*Last Name
				<input type="text" name="s_lastName" id="s_lastName" value = "<?php if(isset($s_lastName)) {echo $s_lastName;}?>">
				<br>
				
				*Address: 
				<input type="text" name="s_address" id="s_address" value = "<?php if(isset($s_address)) {echo $s_address;}?>" >
				<br>
				
				*City: 
				<input type="text" name="s_city" id="s_city" value = "<?php if(isset($s_city)) {echo $s_city;}?>">
				<br>
				
				*State: 
				<select name="s_state" id="s_state">
 <option value="">Choose State</option>
  <option value="AL" <?php if($s_state=="AL"){echo "selected";}?>>Alabama</option>
  <option value="AK" <?php if($s_state=="AK"){echo "selected";}?>>Alaska</option>
  <option value="AZ" <?php if($s_state=="AZ"){echo "selected";}?>>Arizona</option>
  <option value="AR" <?php if($s_state=="AR"){echo "selected";}?>>Arkansas</option>
  <option value="CA" <?php if($s_state=="CA"){echo "selected";}?>>California</option>
  <option value="CO" <?php if($s_state=="CO"){echo "selected";}?>>Colorado</option>
  <option value="CT" <?php if($s_state=="CT"){echo "selected";}?>>Connecticut</option>
  <option value="DE" <?php if($s_state=="DE"){echo "selected";}?>>Delaware</option>
  <option value="DC" <?php if($s_state=="DC"){echo "selected";}?>>District Of Columbia</option>
  <option value="FL" <?php if($s_state=="FL"){echo "selected";}?>>Florida</option>
  <option value="GA" <?php if($s_state=="GA"){echo "selected";}?>>Georgia</option>
  <option value="HI" <?php if($s_state=="HI"){echo "selected";}?>>Hawaii</option>
  <option value="ID" <?php if($s_state=="ID"){echo "selected";}?>>Idaho</option>
  <option value="IL" <?php if($s_state=="IL"){echo "selected";}?>>Illinois</option>
  <option value="IN" <?php if($s_state=="IN"){echo "selected";}?>>Indiana</option>
  <option value="IA" <?php if($s_state=="IA"){echo "selected";}?>>Iowa</option>
  <option value="KS" <?php if($s_state=="KS"){echo "selected";}?>>Kansas</option>
  <option value="KY" <?php if($s_state=="KY"){echo "selected";}?>>Kentucky</option>
  <option value="LA" <?php if($s_state=="LA"){echo "selected";}?>>Louisiana</option>
  <option value="ME" <?php if($s_state=="ME"){echo "selected";}?>>Maine</option>
  <option value="MD" <?php if($s_state=="MD"){echo "selected";}?>>Maryland</option>
  <option value="MA" <?php if($s_state=="MA"){echo "selected";}?>>Massachusetts</option>
  <option value="MI" <?php if($s_state=="MI"){echo "selected";}?>>Michigan</option>
  <option value="MN" <?php if($s_state=="MN"){echo "selected";}?>>Minnesota</option>
  <option value="MS" <?php if($s_state=="MS"){echo "selected";}?>>Mississippi</option >
  <option value="MO" <?php if($s_state=="MO"){echo "selected";}?>>Missouri</option>
  <option value="MT" <?php if($s_state=="MT"){echo "selected";}?>>Montana</option>
  <option value="NE" <?php if($s_state=="NE"){echo "selected";}?>>Nebraska</option>
  <option value="NV" <?php if($s_state=="NV"){echo "selected";}?>>Nevada</option>
  <option value="NH" <?php if($s_state=="NH"){echo "selected";}?>>New Hampshire</option>
  <option value="NJ" <?php if($s_state=="NJ"){echo "selected";}?>>New Jersey</option>
  <option value="NM" <?php if($s_state=="NM"){echo "selected";}?>>New Mexico</option>>
  <option value="NY" <?php if($s_state=="NY"){echo "selected";}?>>New York</option >
  <option value="NC" <?php if($s_state=="NY"){echo "selected";}?>>North Carolina</option>
  <option value="ND" <?php if($s_state=="ND"){echo "selected";}?>>North Dakota</option>
  <option value="OH" <?php if($s_state=="OH"){echo "selected";}?>>Ohio</option>
  <option value="OK" <?php if($s_state=="OK"){echo "selected";}?>>Oklahoma</option>
  <option value="OR" <?php if($s_state=="OR"){echo "selected";}?>>Oregon</option>
  <option value="PA" <?php if($s_state=="PA"){echo "selected";}?>>Pennsylvania</option>
  <option value="RI" <?php if($s_state=="RI"){echo "selected";}?>>Rhode Island</option>
  <option value="SC" <?php if($s_state=="SC"){echo "selected";}?>>South Carolina</option>
  <option value="SD" <?php if($s_state=="SD"){echo "selected";}?>>South Dakota</option>
  <option value="TN" <?php if($s_state=="TN"){echo "selected";}?>>Tennessee</option>
  <option value="TX" <?php if($s_state=="TX"){echo "selected";}?>>Texas</option>
  <option value="UT" <?php if($s_state=="UT"){echo "selected";}?>>Utah</option>
  <option value="VT" <?php if($s_state=="VT"){echo "selected";}?>>Vermont</option>
  <option value="VA" <?php if($s_state=="VA"){echo "selected";}?>>Virginia</option>
  <option value="WA" <?php if($s_state=="WA"){echo "selected";}?>>Washington</option>
  <option value="WV" <?php if($s_state=="WV"){echo "selected";}?>>West Virginia</option>
  <option value="WI" <?php if($s_state=="WI"){echo "selected";}?>>Wisconsin</option>
  <option value="WY" <?php if($s_state=="WY"){echo "selected";}?>>Wyoming</option>
  </select>
				<br>
				
				*Zip Code: 
				<input type="text" name="s_zip" id="s_zip" value = "<?php if(isset($s_zip)) {echo $s_zip;}?>">
				<br>
				<input type="checkbox" name="same"id="same">Billing info same as shipping?<br>
				<br>
				
				<div id="billing">
				<h2 class="form_header">Billing Information</h2><br>
				
				*First Name: 
				<input type="text" name="b_firstName" id="b_firstName" value = "<?php if(isset($b_firstName)) {echo $b_firstName;}?>">
				<br>
				
				*Last Name
				<input type="text" name="b_lastName" id="b_lastName" value = "<?php if(isset($b_lastName)) {echo $b_lastName;}?>">
				<br>
				
				*Address: 
				<input type="text" name="b_address" id="b_address" value = "<?php if(isset($b_address)) echo $b_address;?>">
				<br>
				
				*City: 
				<input type="text" name="b_city" id="b_city" value = "<?php if(isset($b_city)) {echo $b_city;}?>">
				<br>
				
				*State: 
				<select name="b_state" id="b_state">
 <option value="">Choose State</option>
  <option value="AL" <?php if($b_state=="AL"){echo "selected";}?>>Alabama</option>
  <option value="AK" <?php if($b_state=="AK"){echo "selected";}?>>Alaska</option>
  <option value="AZ" <?php if($b_state=="AZ"){echo "selected";}?>>Arizona</option>
  <option value="AR" <?php if($b_state=="AR"){echo "selected";}?>>Arkansas</option>
  <option value="CA" <?php if($b_state=="CA"){echo "selected";}?>>California</option>
  <option value="CO" <?php if($b_state=="CO"){echo "selected";}?>>Colorado</option>
  <option value="CT" <?php if($b_state=="CT"){echo "selected";}?>>Connecticut</option>
  <option value="DE" <?php if($b_state=="DE"){echo "selected";}?>>Delaware</option>
  <option value="DC" <?php if($b_state=="DC"){echo "selected";}?>>District Of Columbia</option>
  <option value="FL" <?php if($b_state=="FL"){echo "selected";}?>>Florida</option>
  <option value="GA" <?php if($b_state=="GA"){echo "selected";}?>>Georgia</option>
  <option value="HI" <?php if($b_state=="HI"){echo "selected";}?>>Hawaii</option>
  <option value="ID" <?php if($b_state=="ID"){echo "selected";}?>>Idaho</option>
  <option value="IL" <?php if($b_state=="IL"){echo "selected";}?>>Illinois</option>
  <option value="IN" <?php if($b_state=="IN"){echo "selected";}?>>Indiana</option>
  <option value="IA" <?php if($b_state=="IA"){echo "selected";}?>>Iowa</option>
  <option value="KS" <?php if($b_state=="KS"){echo "selected";}?>>Kansas</option>
  <option value="KY" <?php if($b_state=="KY"){echo "selected";}?>>Kentucky</option>
  <option value="LA" <?php if($b_state=="LA"){echo "selected";}?>>Louisiana</option>
  <option value="ME" <?php if($b_state=="ME"){echo "selected";}?>>Maine</option>
  <option value="MD" <?php if($b_state=="MD"){echo "selected";}?>>Maryland</option>
  <option value="MA" <?php if($b_state=="MA"){echo "selected";}?>>Massachusetts</option>
  <option value="MI" <?php if($b_state=="MI"){echo "selected";}?>>Michigan</option>
  <option value="MN" <?php if($b_state=="MN"){echo "selected";}?>>Minnesota</option>
  <option value="MS" <?php if($b_state=="MS"){echo "selected";}?>>Mississippi</option >
  <option value="MO" <?php if($b_state=="MO"){echo "selected";}?>>Missouri</option>
  <option value="MT" <?php if($b_state=="MT"){echo "selected";}?>>Montana</option>
  <option value="NE" <?php if($b_state=="NE"){echo "selected";}?>>Nebraska</option>
  <option value="NV" <?php if($b_state=="NV"){echo "selected";}?>>Nevada</option>
  <option value="NH" <?php if($b_state=="NH"){echo "selected";}?>>New Hampshire</option>
  <option value="NJ" <?php if($b_state=="NJ"){echo "selected";}?>>New Jersey</option>
  <option value="NM" <?php if($b_state=="NM"){echo "selected";}?>>New Mexico</option>>
  <option value="NY" <?php if($b_state=="NY"){echo "selected";}?>>New York</option >
  <option value="NC" <?php if($b_state=="NY"){echo "selected";}?>>North Carolina</option>
  <option value="ND" <?php if($b_state=="ND"){echo "selected";}?>>North Dakota</option>
  <option value="OH" <?php if($b_state=="OH"){echo "selected";}?>>Ohio</option>
  <option value="OK" <?php if($b_state=="OK"){echo "selected";}?>>Oklahoma</option>
  <option value="OR" <?php if($b_state=="OR"){echo "selected";}?>>Oregon</option>
  <option value="PA" <?php if($b_state=="PA"){echo "selected";}?>>Pennsylvania</option>
  <option value="RI" <?php if($b_state=="RI"){echo "selected";}?>>Rhode Island</option>
  <option value="SC" <?php if($b_state=="SC"){echo "selected";}?>>South Carolina</option>
  <option value="SD" <?php if($b_state=="SD"){echo "selected";}?>>South Dakota</option>
  <option value="TN" <?php if($b_state=="TN"){echo "selected";}?>>Tennessee</option>
  <option value="TX" <?php if($b_state=="TX"){echo "selected";}?>>Texas</option>
  <option value="UT" <?php if($b_state=="UT"){echo "selected";}?>>Utah</option>
  <option value="VT" <?php if($b_state=="VT"){echo "selected";}?>>Vermont</option>
  <option value="VA" <?php if($b_state=="VA"){echo "selected";}?>>Virginia</option>
  <option value="WA" <?php if($b_state=="WA"){echo "selected";}?>>Washington</option>
  <option value="WV" <?php if($b_state=="WV"){echo "selected";}?>>West Virginia</option>
  <option value="WI" <?php if($b_state=="WI"){echo "selected";}?>>Wisconsin</option>
  <option value="WY" <?php if($b_state=="WY"){echo "selected";}?>>Wyoming</option>
  </select>
				<br>
				
				*Zip Code: 
				<input type="text" name="b_zip" id="b_zip" value = "<?php if(isset($b_zip)) {echo $b_zip;}?>">
				<br>
				
				
				</div>
				<input type="submit" id="submit" name="submit">
			
				</form>
				
	
  
  
  
 <?php include('footer.php');?>