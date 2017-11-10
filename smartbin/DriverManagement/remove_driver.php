<?php
require "driver_connect.php";

$USER_NAME =$_POST["user_name"];
//$USER_NAME = "p" ;

$qry_search = " SELECT * FROM driver_registration_table WHERE user_name LIKE '$USER_NAME' ";
$result = $conn->query($qry_search);

if($result->num_rows > 0){

	$query_delete = "DELETE FROM driver_registration_table WHERE user_name='$USER_NAME' " ;
	if($conn->query($query_delete) === TRUE){
		echo "Driver Has been successfully Removed";
	}else{
		echo "Error in Removing Driver" ;
	}
}else{
	echo "Driver User Name NOT found in Database";
}

?>
