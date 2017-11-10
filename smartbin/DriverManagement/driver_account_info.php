<?php
require 'driver_connect.php'; // database1 connection.

// Driver account-info.

$user_name = $_POST["user_name"];
//$user_email = 'nabeel';

$qry = " SELECT user_name,name,mob_no,vehicle_no FROM driver_registration_table WHERE user_name='$user_name' ";

$result = $conn->query($qry);
if($result->num_rows > 0)
{
	$row = $result->fetch_assoc();
	echo (json_encode($row));
}
else echo 'Data not found in database';
?>