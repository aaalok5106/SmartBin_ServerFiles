<?php

// Admin Login php.

require "connect.php";
$user_email = $_POST["email"]; //"aaalok5106@gmail.com";
$user_pass = hash('sha512' , $_POST["password"]); //"1234....";
$mysql_qry = "select * from user_registration where email like '$user_email' and password like '$user_pass';";

$result = mysqli_query($conn, $mysql_qry);
if(mysqli_num_rows($result) > 0 )
{
	echo "You are successfully Logged In";
}
else
{
	echo "Sorry! Input credentials are WRONG...Please Login with valid credentials!";
}
?>