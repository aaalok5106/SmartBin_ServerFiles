<?php
require "conn.php";

$query1 = "select bin_id from bin_location_filled";
$query2 = "DELETE FROM all_combinations_filled_bins";
$conn->query($query2);
$result1 = $conn->query($query1);

$array_bin_id = array();

if($result1->num_rows > 0){
	while($row = $result1->fetch_assoc()){
		$array_bin_id[] = $row['bin_id'];
	}
}

$len = count($array_bin_id);
for($i=0 ; $i < $len-1 ; $i++){
	for($j=$i+1 ; $j<$len ; $j++){
		
		$qry1 = "insert into all_combinations_filled_bins select * from all_combinations_installed_bins where bin_id_from = '$array_bin_id[$i]' and bin_id_to = '$array_bin_id[$j]'";
		$result1 = $conn->query($qry1);
		
		$qry2 = "insert into all_combinations_filled_bins select * from all_combinations_installed_bins where bin_id_from = '$array_bin_id[$j]' and bin_id_to = '$array_bin_id[$i]'";
		$conn->query($qry2);
	}
}
?>