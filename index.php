<?php session_start();
 include('connect-db.php');?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Hot Ash Cigars</title>
  <link rel="stylesheet" href="stylesheet.css" type="text/css">
  <style type="text/css">
  #spaceholder {
	  height: 465px;
  }
	   .fotorama {
	 margin: auto;
	 text-align: center;
	   
	   
	   
   }
   
   #slideholder{
   	width: 40%;
 	display: inline-block;
   	margin-top: 40px;
   	text-align: center;
   	float: left;
   }
   #indexContent {
   	display: inline-block;
   	width: 30%;
   	color: rgb(39, 170, 225);
   	margin-top: 150px;
   	margin-left: 30px;
   	font-size: 28px;
   	
   }
   nav {
	margin-right: 50px;   
   }
   nav li:nth-child(1){
   	background-color: yellow;
   }
   
   .logo {
   margin-top: 50px;
  }
   
   
  </style>
	  <!-- jQuery -->
  <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
	
  <!-- Fotorama -->
  

  <!-- Just don’t want to repeat this prefix in every img[src] -->


  </head>
 
  <?php include('header.php');?>
  <div id="slideholder">

  <img src="cigar3.jpg" width="100%">

</div>
<div id="indexContent">Cigars are our primary concern. Want quality cigars? Look no further. We have what you need at prices impossible to beat.</div><br>
  

<h2 class="logo"></h2>
 <?php include('footer.php');?>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 <script src="external.js"></script>