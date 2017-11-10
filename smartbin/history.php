<?php
require "conn.php";

$query="insert into history_filled_bins select * from bin_location_filled where path_making_status='1'";
if($conn->query($query)==TRUE){
	
}else{
	echo "Data Insertion Error";
	//echo $conn->error;
}
$query1="delete from bin_location_filled where path_making_status='1'";
if($conn->query($query1)==TRUE){
	echo "Flushing Done";
}else{
	echo "Data Could not be Flushed";
	//echo "Data Could not be Flushed" . " " .$conn->error;
}

?>
