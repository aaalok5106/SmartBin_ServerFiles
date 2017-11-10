<?php

// This PHP will be used to send data of ALL INSTALLED BINS.

$db_name = "database3";
$mysql_username = "root";
$mysql_password = "1234....";
$server_name = "localhost";

$con = new mysqli($server_name , $mysql_username , $mysql_password , $db_name);

if($con->connect_error){
	die("Connection failed: ". $con->connect_error);
}else{
}
$query = "SELECT lat,lng,bin_id FROM bin_location_data2";
$res = $con->query($query) ;

if($res->num_rows >0 ){
	/*echo "ID's are :"."<br>";*/
	while($row = $res->fetch_assoc()){
		$flag[]=$row; /*echo $row["lat"]."<br>"; */
	}
	
	print(json_encode($flag));
}
else{
die("No data found !");
}
?>