<?php
require "conn.php";

$previous = date('Y-m-d H:i:s' , strtotime('-7 days'));
$now = date('Y-m-d H:i:s');

$q = "delete from notification";
$conn->query($q);

$query1 = "select bin_id , date_time from history_filled_bins where date_time > '$previous'";
$result1 = $conn->query($query1);

$array_bin_id = array();

if($result1->num_rows > 0){
	while($row = $result1->fetch_assoc()){
		$array_bin_id[] = $row['bin_id'];
	}
}
$l1 = count($array_bin_id);

$query2 = "select bin_id from bin_location_data2";
$result2 = $conn->query($query2);

if($result2->num_rows > 0){
	while($row = $result2->fetch_assoc()){
		$array_bin_id_installed[] = $row['bin_id'];
	}
}

$l3 = count($array_bin_id_installed);

$array_bins = "";
$array_msg = "";
$count=0;
for($i=0 ; $i<$l3 ; $i++){
	$array_bins = $array_bin_id_installed[$i];
	for($j=0 ; $j<$l1 ; $j++){
		if($array_bin_id[$j] == $array_bin_id_installed[$i]){
			$count++;
		}
	}
	if($count > 3){
		$array_msg = "Recommended to install more bins here";
	}else{
		$array_msg = "";
	}
	$query4 = "insert into notification (bin_id , numbers , message) values ('$array_bins' , '$count' , '$array_msg')";
	$conn->query($query4);
	$count=0;
}

$query = "SELECT bin_id , numbers , message FROM notification";
$res = $conn->query($query) ;

if($res->num_rows >0 ){
	while($row2 = $res->fetch_assoc()){
		$flag[]=$row2;
	}
	print(json_encode($flag));
}

?>