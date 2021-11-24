<?php

//incldue constant.php fro SITEURL
include("../config/constant.php");
//Destroy the session

session_destroy(); //unsets $_SESSION['user']
// 2Redirect to login Page
header("location: ".SITEURL."admin/login.php");

?>