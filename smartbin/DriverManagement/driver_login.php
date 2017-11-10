<?php

// Driver Login php.

require "driver_connect.php";
$user_name = $_POST["user_name"]; //"aaalok5106@gmail.com";
$user_pass = $_POST["password"]; //"1234....";
$mysql_qry = "select * from driver_registration_table where user_name like '$user_name' and password like '$user_pass';";

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