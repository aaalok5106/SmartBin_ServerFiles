<?php
require "conn.php";

$placeId = $_POST["email"];
$name = $_POST["name"];
$address = $_POST["mob_no"];
$lat = $_POST["lat"];
$lng = $_POST["lng"];

/*
$placeId = "6666";
$name = "5555";
$address = "4444";
$lat = "2222";
$lng = "3333";
*/


if($conn->connect_error){
	die("Connection Failed: ". $conn->connect_error);
}else{

$query1 = "select * from bin_location_data2 order by sl_no desc limit 1";
$result1 = $conn->query($query1);
$last_id="";
$num="";
$string="";
if($result1->num_rows > 0){
	while($row = $result1->fetch_assoc()){
		$last_id = $row["bin_id"];
	}
	
	$num[0]=$last_id[3];
	$num[1]=$last_id[4];
	$num[2]=$last_id[5];
	
	$num = $num[0].$num[1].$num[2] ;
	$numNew = (int)$num;
	$num1 = sprintf("%03d" , ++$numNew);
	$string = "BIN".$num1 ;
	
	}else{
	$string = "BIN001";
}

$name=str_replace("'" , "\'" , $name);
$mysql_qry = "insert into bin_location_data2 (bin_id , placeId, name, address, lat, lng) values ('$string' , '$placeId','$name', '$address', '$lat', '$lng')";

if($conn->query($mysql_qry) == TRUE)
{
	echo "Bin Position successfully inserted on server";
}
else
{
	//echo "Error: " . $mysql_qry . "<br>" . $conn->error;
	echo "Error Inserting Bin-Data on Server";
}
}
$conn->close() ;
//shell_exec('php distance.php');
//include('distance.php');
?>