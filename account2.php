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

  </style>
  </head>
<?php include('header.php');?>

<?php if ($_SERVER["REQUEST_METHOD"] == "POST"){
	
	$username = test_input($_POST["username"]);
	$password = test_input($_POST["password"]);
	$email = test_input($_POST["email"]);
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
<?php
if(!isset($email)) {$username = $_GET["username"];
	$password = $_GET["password"];
	$email = $_GET["email"];}?>
  
  <h2 class="logo">Create An Account</h2>
  
 
  
  <form method="post" id="user" action="<?php echo($_SERVER["PHP_SELF"]);?>">
				 <button id="startover"><a href="account.php" style="text-decoration: none;">Start Over</a></button>
				<div id="shipping"><h2 class="form_header">Shipping Information</h2><br>
				
				<input type="hidden" name="username" id="username" value="<?php echo $username;?>">
				<input type="hidden" name="email" id="email" value="<?php echo $email;?>">
				<input type="hidden" name="password" id="password" value="<?php echo $password;?>">
				
				*First Name: 
				<input type="text" name="s_firstName" id="s_firstName" >
				<br>
				
				*Last Name
				<input type="text" name="s_lastName" id="s_lastName">
				<br>
				
				*Address: 
				<input type="text" name="s_address" id="s_address" >
				<br>
				
				*City: 
				<input type="text" name="s_city" id="s_city">
				<br>
				
				*State: 
				<select name="s_state" id="s_state">
 <option value="">Choose State</option>
  <option value="AL">Alabama</option>
  <option value="AK">Alaska</option>
  <option value="AZ">Arizona</option>
  <option value="AR">Arkansas</option>
  <option value="CA">California</option>
  <option value="CO">Colorado</option>
  <option value="CT">Connecticut</option>
  <option value="DE">Delaware</option>
  <option value="DC">District Of Columbia</option>
  <option value="FL">Florida</option>
  <option value="GA">Georgia</option>
  <option value="HI">Hawaii</option>
  <option value="ID">Idaho</option>
  <option value="IL">Illinois</option>
  <option value="IN">Indiana</option>
  <option value="IA">Iowa</option>
  <option value="KS">Kansas</option>
  <option value="KY">Kentucky</option>
  <option value="LA">Louisiana</option>
  <option value="ME">Maine</option>
  <option value="MD">Maryland</option>
  <option value="MA">Massachusetts</option>
  <option value="MI">Michigan</option>
  <option value="MN">Minnesota</option>
  <option value="MS">Mississippi</option>
  <option value="MO">Missouri</option>
  <option value="MT">Montana</option>
  <option value="NE">Nebraska</option>
  <option value="NV">Nevada</option>
  <option value="NH">New Hampshire</option>
  <option value="NJ">New Jersey</option>
  <option value="NM">New Mexico</option>
  <option value="NY">New York</option>
  <option value="NC">North Carolina</option>
  <option value="ND">North Dakota</option>
  <option value="OH">Ohio</option>
  <option value="OK">Oklahoma</option>
  <option value="OR">Oregon</option>
  <option value="PA">Pennsylvania</option>
  <option value="RI">Rhode Island</option>
  <option value="SC">South Carolina</option>
  <option value="SD">South Dakota</option>
  <option value="TN">Tennessee</option>
  <option value="TX">Texas</option>
  <option value="UT">Utah</option>
  <option value="VT">Vermont</option>
  <option value="VA">Virginia</option>
  <option value="WA">Washington</option>
  <option value="WV">West Virginia</option>
  <option value="WI">Wisconsin</option>
  <option value="WY">Wyoming</option>
  </select>
				<br>
				
				*Zip Code: 
				<input type="text" name="s_zip" id="s_zip">
				<br>
				<input type="checkbox" name="same"id="same">Billing info same as shipping?<br>
				</div><br>
				
				<div id="billing">
				<h2 class="form_header">Billing Information</h2><br>
				
				*First Name: 
				<input type="text" name="b_firstName" id="b_firstName" >
				<br>
				
				*Last Name
				<input type="text" name="b_lastName" id="b_lastName">
				<br>
				
				*Address: 
				<input type="text" name="b_address" id="b_address" >
				<br>
				
				*City: 
				<input type="text" name="b_city" id="b_city">
				<br>
				
				*State: 
				<select name="b_state" id="b_state">
 <option value="">Choose State</option>
  <option value="AL">Alabama</option>
  <option value="AK">Alaska</option>
  <option value="AZ">Arizona</option>
  <option value="AR">Arkansas</option>
  <option value="CA">California</option>
  <option value="CO">Colorado</option>
  <option value="CT">Connecticut</option>
  <option value="DE">Delaware</option>
  <option value="DC">District Of Columbia</option>
  <option value="FL">Florida</option>
  <option value="GA">Georgia</option>
  <option value="HI">Hawaii</option>
  <option value="ID">Idaho</option>
  <option value="IL">Illinois</option>
  <option value="IN">Indiana</option>
  <option value="IA">Iowa</option>
  <option value="KS">Kansas</option>
  <option value="KY">Kentucky</option>
  <option value="LA">Louisiana</option>
  <option value="ME">Maine</option>
  <option value="MD">Maryland</option>
  <option value="MA">Massachusetts</option>
  <option value="MI">Michigan</option>
  <option value="MN">Minnesota</option>
  <option value="MS">Mississippi</option>
  <option value="MO">Missouri</option>
  <option value="MT">Montana</option>
  <option value="NE">Nebraska</option>
  <option value="NV">Nevada</option>
  <option value="NH">New Hampshire</option>
  <option value="NJ">New Jersey</option>
  <option value="NM">New Mexico</option>
  <option value="NY">New York</option>
  <option value="NC">North Carolina</option>
  <option value="ND">North Dakota</option>
  <option value="OH">Ohio</option>
  <option value="OK">Oklahoma</option>
  <option value="OR">Oregon</option>
  <option value="PA">Pennsylvania</option>
  <option value="RI">Rhode Island</option>
  <option value="SC">South Carolina</option>
  <option value="SD">South Dakota</option>
  <option value="TN">Tennessee</option>
  <option value="TX">Texas</option>
  <option value="UT">Utah</option>
  <option value="VT">Vermont</option>
  <option value="VA">Virginia</option>
  <option value="WA">Washington</option>
  <option value="WV">West Virginia</option>
  <option value="WI">Wisconsin</option>
  <option value="WY">Wyoming</option>
  </select>
				<br>
				
				*Zip Code: 
				<input type="text" name="b_zip" id="b_zip">
				<br>
				
				
				</div>
					
				<input type="submit" name="submit" id="submit" value="Submit">
				</form>
  
  
  
 <?php include('footer.php');?>