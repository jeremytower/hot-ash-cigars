<?php session_start();
 include('connect-db.php');?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Hot Ash Cigars</title>
  <link rel="stylesheet" href="stylesheet.css" type="text/css">
  <style type="text/css">
   nav li:nth-child(4){
   	background-color: yellow;
   	
   }
   
   #map {
 
      position: absolute;
      left: 35%;
      top: 200px;
       
   }
   
   
   
   
     .pin{
  width: 30px;
  height: 30px;
  border-radius: 50% 50% 50% 0;
  background: rgb(39, 170, 225);
  position: absolute;
  transform: rotate(-45deg);
  left: 61%;
  top: 49%;
  margin: -20px 0 0 -20px;
  animation-name: bounce;
  animation-fill-mode: both;
  animation-duration: 1s;
  z-index: 100;
}
  .pin:after{
    content: '';
    width: 14px;
    height: 14px;
    margin: 8px 0 0 8px;
    background:  #2F2F2F;
    position: absolute;
    border-radius: 50%;
}
.pulse{
  background: rgba(0,0,0,0.2);
  border-radius: 50%;
  height: 14px;
  width: 14px;
  position: absolute;
  left: 61%;
  top: 49%;
  margin: 11px 0px 0px -12px;
  transform: rotateX(55deg);
z-index: 101;}
  .pulse:after{
    content: "";
    border-radius: 50%;
    height: 40px;
    width: 40px;
    position: absolute;
    margin: -13px 0 0 -13px;
    animation: pulsate 1s ease-out;
    animation-iteration-count: infinite;
    opacity: 0.0;
    box-shadow: 0 0 1px 2px #89849b;
    animation-delay: 1.1s;
}
@keyframes pulsate{
  0%{
    transform: scale(0.1, 0.1);
  opacity: 0.0;}
  50%{
  opacity: 1.0;}
  100%{
    transform: scale(1.2, 1.2);
  opacity: 0;}
}
@keyframes bounce{
  0%{
    opacity: 0;
  transform: translateY(-2000px) rotate(-45deg);}
  60%{
    opacity: 1;
  transform: translateY(30px) rotate(-45deg);}
  80%{
  transform: translateY(-10px) rotate(-45deg);}
  100%{
  transform: translateY(0) rotate(-45deg);}
  
   
   
   
   
  </style>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="jquery.validate.js" type="text/javascript"></script>
	<script src="external.js"></script>
  </head>
<?php include('header.php');?>
  <div class='pin'></div>
<div class='pulse'></div>
<div id="map"><img src="denver_center.jpg"></div>
<br><br><br><br><br><br><br><br>
 <?php include('footer.php');?>