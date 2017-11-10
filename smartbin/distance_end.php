<?php

require "conn.php";

// This PHP wil be required to Generate all combinations of Travel-Distance & Time b/w two points on Map and store them in separate table.

/*
$query1 = "select lat , lng from bin_location_filled where sl_no='45'";
$query2 = "select lat , lng from bin_location_filled where sl_no='46'";
$res1=$conn->query($query1);
$res2=$conn->query($query2);
$row1=$res1->fetch_assoc();
$row2=$res2->fetch_assoc();
$lat1=$row1["lat"];
$lat2=$row2["lat"];
$lng1=$row1["lng"];
$lng2=$row2["lng"];

echo "----" .$lat1." " . $lat2." " . $lng1 ." ". $lng2 ;
*/

	$qry1 = "delete from all_combinations_installed_bins where bin_id_from = 'BINEND'";
	$conn->query($qry1);
	$qry2 = "delete from all_combinations_installed_bins where bin_id_to = 'BINEND'";
	$conn->query($qry2);

$query1 = "select bin_id , lat , lng from bin_location_data2";
$result1 = $conn->query($query1);

$array_bin_id = array();
$array_lat = array();
$array_lng = array();


$last_bin_id = "";
$last_lat = "";
$last_lng = "";

//Finding new added bin2
$query3 = "select * from start_end_path_position where bin_id = 'BINEND'";
$result2 = $conn->query($query3);

if($result2->num_rows > 0){
	
	while($last_row = $result2->fetch_assoc()){
		$last_bin_id = $last_row['bin_id'];
		$last_lat = $last_row['lat'];
		$last_lng = $last_row['lng'];
	}
}

if ($result1->num_rows > 0)
{
	while($row = $result1->fetch_assoc())
	{
		$array_bin_id[] = $row['bin_id'];
		$array_lat[] = $row['lat'];
		$array_lng[] = $row['lng'];
	}
}

$l1 = count($array_lat);
$l2 = count($array_lng);

if($l1 == $l2){
	for($i=0 ; $i<$l1 ; $i++){
				
				$distance = GetDrivingDistance($array_lat[$i], $last_lat, $array_lng[$i], $last_lng);
				$DIST = $distance['distance'];
				$TIME = $distance['time'];
				
				$bin_id_from = $array_bin_id[$i];
				$lat_from = $array_lat[$i];
				$lng_from = $array_lng[$i];
				
				$bin_id_to = $last_bin_id;
				$lat_to = $last_lat;
				$lng_to = $last_lng;
				
				$qry_insert = "insert into all_combinations_installed_bins (bin_id_from , lat_from, lng_from, bin_id_to, lat_to, lng_to, travel_distance, travel_time) values ('$bin_id_from', '$lat_from','$lng_from', '$bin_id_to', '$lat_to', '$lng_to', '$DIST', '$TIME' )";
		        $conn->query($qry_insert);	
	}
}

function GetDrivingDistance($lat1, $lat2, $lng1, $lng2)
{
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$lng1."&destinations=".$lat2.",".$lng2."&mode=driving&language=en-US";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    curl_close($ch);
    $response_a = json_decode($response, true);
	//$status = $response_a['rows'][0]['elements'][0]['status']; // "status" : "OK"
    //$dist = $response_a['rows'][0]['elements'][0]['distance']['text'];
    //$time = $response_a['rows'][0]['elements'][0]['duration']['text'];
	
	$dist = $response_a['rows'][0]['elements'][0]['distance']['value'];
    $time = $response_a['rows'][0]['elements'][0]['duration']['value'];

	//echo "distance =>". $dist . " || time =>" .$time ;
    return array('distance' => $dist, 'time' => $time);
}

?>