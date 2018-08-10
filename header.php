<?php if($_SESSION['loggedIn'] == 1){
	include('header_loggedIn.php');
}
	else {
		include('header_loggedOut.php');
	}
?>