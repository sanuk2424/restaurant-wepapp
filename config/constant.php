
<?php
//start the session
session_start();

define('SITEURL','http://localhost/food-order/');

//Create Constant to store non repeating values.
define('DB_HOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','food-order');


  $conn = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());   //Database connection
  $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error()); //Selecting database
?>