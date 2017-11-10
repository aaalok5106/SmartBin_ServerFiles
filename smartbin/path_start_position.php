<?php
require 'conn.php';

$placeId = $_POST["email"];
$name = $_POST["name"];
$address = $_POST["mob_no"];
$lat = $_POST["lat"];
$lng = $_POST["lng"];
$name=str_replace("'" , "\'" , $name);
//$PERCENTAGE_FILLED = "0.0";

/*
$placeId = "ssssssss";
$name = "jbjkk";
$address = "4445468kl4";
$lat = "222200000000";
$lng = "3333222000000";
*/
if($conn->connect_error){
	die("Connection Failed: ". $conn->connect_error);
}else{
	$BIN_ID = "BINSTART";
	$qry = "delete from start_end_path_position where bin_id='BINSTART'";
	$conn->query($qry);
	$qry_insert = "insert into start_end_path_position (bin_id , placeId, name, address, lat, lng) values ('$BIN_ID' , '$placeId','$name', '$address', '$lat', '$lng')";
	if( $conn->query($qry_insert)==TRUE){
		echo "Start Position Successfully Inserted";
	}else{
		echo "ERROR in Inserting Start Position";
	}
	/*
	$qry = "SELECT * FROM start_end_path_position WHERE bin_id LIKE '$BIN_ID' ";
	
	$result = $conn->query($qry);
	
	$qry_update_result = FALSE;
	$qry_insert_result = FALSE;
	
	if($result->num_rows > 0){
		$row = $result->fetch_assoc();
		if($row['bin_id']===$BIN_ID){
			$qry_update = "UPDATE start_end_path_position SET placeId = '$placeId' , name = '$name' , address = '$address' , lat = '$lat' , lng = '$lng' WHERE bin_id = '$BIN_ID' ";
			$qry_update_result = $conn->query($qry_update);
		}
	}else{
		$qry_insert = "insert into start_end_path_position (bin_id , placeId, name, address, lat, lng) values ('$BIN_ID' , '$placeId','$name', '$address', '$lat', '$lng')";
		$qry_insert_result = $conn->query($qry_insert);
	}
	
	if( $qry_insert_result===TRUE || $qry_update_result===TRUE ){
		echo "Start Position Updated/Inserted.";
	}else{
		echo "ERROR in Inserting/Updating Position.";
	}
	*/
}
$conn->close();
?>