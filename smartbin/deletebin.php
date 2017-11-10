<?php

require "conn.php";

$binid=$_POST["bin_id"];

$query = "DELETE FROM bin_location_data2 WHERE bin_id='$binid'" ;
$query1= "DELETE FROM all_combinations_filled_bins WHERE bin_id_from='$binid'";
$query2= "DELETE FROM all_combinations_filled_bins WHERE bin_id_to='$binid'";

if($conn->query($query) == true){
echo "Bin Has been Deleted";
}else{
die ("Error in Deleting bin " . $conn->error);
}
$conn->query($query1);
$conn->query($query2);

?>
