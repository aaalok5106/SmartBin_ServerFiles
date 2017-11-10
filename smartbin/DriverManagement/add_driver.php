<?php
require "driver_connect.php";

// Drivers registration by admin php.

$USER_NAME = $_POST["user_name"];
$NAME = $_POST["name"];
$MOB_NO = $_POST["mob_no"];
$VEHICLE_NO = $_POST["vehicle_no"];
$PASSWORD = $_POST["password"];
/*
$USER_NAME = "b";
$NAME = "a";
$MOB_NO = "1";
$VEHICLE_NO = "1";
$PASSWORD = "1"*/
$qry_search = "SELECT * FROM driver_registration_table WHERE user_name LIKE '$USER_NAME' ";
$result = $conn->query($qry_search);
if($result->num_rows > 0){
	echo "Sorry! This UserName is already taken, Try another.";
}
else{
	$mysql_qry = "insert into driver_registration_table (user_name, name, mob_no, vehicle_no, password) values ('$USER_NAME', '$NAME', '$MOB_NO', '$VEHICLE_NO', '$PASSWORD')";

	if($conn->query($mysql_qry) === TRUE)
	{
		echo "Driver Registration Successful...You can now give Driver their UserName & Password to access GarbageCollect App.";
	}
	else
	{
		//echo "Error: " . $mysql_qry . "<br>" . $conn->error;
		echo "Sorry! Error Inserting Registering Data. Please try again.";
	}
}
$conn->close() ;
?>