<?php
require 'connect.php'; // database1 connection.

// Admin account-info.

$user_email = $_POST["email"];
//$user_email = 'nabeel';

$qry = " SELECT email,name,mob_no FROM user_registration WHERE email='$user_email' ";

$result = $conn->query($qry);
if($result->num_rows > 0)
{
	$row = $result->fetch_assoc();
	echo (json_encode($row));
}
else echo 'Data not found in database';
?>