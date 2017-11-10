<?php
require "conn.php";

// This PHP will be required to Update the BIN Status which is FILLED.

$BIN_ID = $_POST["bin_id"];
$PERCENTAGE_FILLED = $_POST["percentage_filled"];



//$BIN_ID = "BIN001";
//$PERCENTAGE_FILLED = "89";



if($conn->connect_error){
	die("Connection Failed: ". $conn->connect_error);
}else{
	
	$qry_search = " SELECT * FROM bin_location_data2 WHERE bin_id LIKE '$BIN_ID' ";
	$qry_search1 = "SELECT * FROM bin_location_filled WHERE bin_id='$BIN_ID'";
	$result = $conn->query($qry_search);
	$result1 = $conn->query($qry_search1);
	if( $result->num_rows > 0 )
	{
		if($result1->num_rows > 0){
			die ("Already In Filled List");
		}
		$row = $result->fetch_assoc();
		if( $row['bin_id']===$BIN_ID )
		{
			$PLACE_ID = $row['placeId'];
			$NAME = $row['name'];
			$ADDRESS = $row['address'];
			$LAT = $row['lat'];
			$LNG = $row['lng'];
			
			$NAME=str_replace("'" , "\'" , $NAME);
			$createdate= date('Y-m-d H:i:s');
			$qry_insert = "insert into bin_location_filled (bin_id, percentage_filled, placeId, name, address, lat, lng, path_making_status, date_time ) values ('$BIN_ID', '$PERCENTAGE_FILLED', '$PLACE_ID', '$NAME', '$ADDRESS', '$LAT', '$LNG' , '0' , '$createdate')";
 
			if($conn->query($qry_insert) === TRUE){
				echo "Bin FILLED Status inserted on server";
			}
			else{
				echo "Error Inserting Bin-Data on Server";
			}
		}

		
	}
	else{
		echo "BIN ID not found on server" ;
	}
}
$conn->close() ;
?>