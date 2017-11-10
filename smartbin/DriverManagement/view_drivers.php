<?php

// This PHP will be required to Get data for List of all Drivers.

$db_name = "database1";
$mysql_username = "root";
$mysql_password = "1234....";
$server_name = "localhost";

$con = new mysqli($server_name , $mysql_username , $mysql_password , $db_name);

if($con->connect_error){
	die("Connection failed: ". $con->connect_error);
}else{

	$query = "SELECT * FROM driver_registration_table";
	$res = $con->query($query) ;

	if($res->num_rows >0 ){
		
		while($row = $res->fetch_assoc()){
			$flag[]=$row;
		}
		
		print(json_encode($flag));
	}
	else{
		echo "No data found !";
	}
}
?>