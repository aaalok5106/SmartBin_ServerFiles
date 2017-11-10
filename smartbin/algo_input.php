<?php
require "conn.php";
require "data_to_all_combinations_filled_bins.php";
require "start_to_filled.php";

$query1 = "select * from bin_location_filled";
$result1 = $conn->query($query1);
$number = $result1->num_rows +1;
$n = $number +1;
$inputfile = fopen("input.txt" , "w") or die ("Unable to open file for input !");
fwrite($inputfile , $number.PHP_EOL);

$array_bin_id = array();
$array_bin_id[] = "BINSTART";

if($result1->num_rows > 0){
	while($row = $result1->fetch_assoc()){
		$array_bin_id[] = $row['bin_id'];
		$id = $row['bin_id'];
		$path_making_update = "update bin_location_filled set path_making_status = '1' where bin_id='$id'";
		$conn->query($path_making_update);
	}
}
for($i=0 ; $i<$number ; $i++){
	for($j=$i ; $j<$number ; $j++){
		if($i==$j){
			fwrite($inputfile , "0"." ");
		}else{
			$query2 = "select travel_distance from all_combinations_filled_bins where bin_id_from='$array_bin_id[$i]' and bin_id_to='$array_bin_id[$j]'";
			$result2=$conn->query($query2);
			$txt="";
			if($result2->num_rows>0){
				$row=$result2->fetch_assoc();
				$txt=$row['travel_distance'];
			}else{
				$query3 = "select travel_distance from all_combinations_filled_bins where bin_id_from='$array_bin_id[$j]' and bin_id_to='$array_bin_id[$i]'";
				$result3=$conn->query($query3);
				if($result3->num_rows>0){
				$row=$result3->fetch_assoc();
				$txt=$row['travel_distance'];
				}
			}
			fwrite($inputfile , $txt." ");
		}
	}
	fwrite($inputfile , PHP_EOL);
}

shell_exec('2-OptPath_initial.exe < input.txt > output.txt');

$del_qry = "delete from result_after_algo";
$conn->query($del_qry);

$outputfile = fopen("output.txt" , "r") or die ("Unable to open output file !");

while(!feof($outputfile) && $n--) {
  $x = (int)fgets($outputfile);
  $text = $array_bin_id[$x];
  if(!($text == 'BINSTART')){
	  $qry_get_details = "select lat , lng from bin_location_data2 where bin_id = '$text'";
	  $result_details = $conn->query($qry_get_details);
	  $result_details_row = $result_details->fetch_assoc();
	  $lat_detail = $result_details_row['lat'];
	  $lng_detail = $result_details_row['lng'];
	  $qry_insert = "insert into result_after_algo (bin_id , lat , lng) values ('$text' , '$lat_detail' , '$lng_detail')" ;
	  $conn->query($qry_insert);
  }else{
	  $qry_get_details = "select lat , lng from start_end_path_position where bin_id = '$text'";
	  $result_details = $conn->query($qry_get_details);
	  $result_details_row = $result_details->fetch_assoc();
	  $lat_detail = $result_details_row['lat'];
	  $lng_detail = $result_details_row['lng'];
	  $qry_insert = "insert into result_after_algo (bin_id , lat , lng) values ('$text' , '$lat_detail' , '$lng_detail')" ;
	  $conn->query($qry_insert);
  }
}
fclose($outputfile);


$q = "SELECT * FROM result_after_algo";
$res = $conn->query($q) ;

if($res->num_rows >0 ){
	
	while($row = $res->fetch_assoc()){
			$flag[]=$row;
	}
	print(json_encode($flag));
}
else{
die("No data found");
}

?>