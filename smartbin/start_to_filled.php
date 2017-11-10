<?php
require "conn.php";
$query1 = "select bin_id from bin_location_filled";

$result1 = $conn->query($query1);
$qry = "delete from all_combinations_filled_bins where bin_id_to = 'BINSTART'";
$conn->query($qry);
$qry4 = "delete from all_combinations_filled_bins where bin_id_to = 'BINEND'";
$conn->query($qry4);

$array_bin_id = array();

if($result1->num_rows > 0){
	while($row = $result1->fetch_assoc()){
		$array_bin_id[] = $row['bin_id'];
	}
}
$len = count($array_bin_id);

for($i=0 ; $i<$len ; $i++){
	
$qry2 = "insert into all_combinations_filled_bins select * from all_combinations_installed_bins where bin_id_from = '$array_bin_id[$i]' and bin_id_to = 'BINSTART'";

$conn->query($qry2);

$qry5 = "insert into all_combinations_filled_bins select * from all_combinations_installed_bins where bin_id_from = '$array_bin_id[$i]' and bin_id_to = 'BINEND'";

$conn->query($qry5);
}

?>