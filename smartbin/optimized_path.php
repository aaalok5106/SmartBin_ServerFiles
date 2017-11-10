<?php

// This PHP will be required to Get data for optimised path from Optimized path table.

$db_name = "database3";
$mysql_username = "root";
$mysql_password = "1234....";
$server_name = "localhost";

$con = new mysqli($server_name , $mysql_username , $mysql_password , $db_name);

if($con->connect_error){
	die("Connection failed: ". $con->connect_error);
}else{
}
$query = "SELECT lat,lng,bin_id FROM bin_location_filled";
$res = $con->query($query) ;

if($res->num_rows >0 ){
	
	while($row = $res->fetch_assoc()){
		if($row['bin_id']==="BINEND"){
			$row_END = $row ;
		}else{
			$flag[]=$row;
		}
	}
	$flag[] = $row_END;
	
	print(json_encode($flag));
}
else{
die("No data found !");
}
?>