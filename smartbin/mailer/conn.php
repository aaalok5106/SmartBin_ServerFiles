<?php

// this php will be used for connecting with database3 .

$db_name = "database3";
$mysql_username = "root";
$mysql_password = "1234....";
$server_name = "localhost";
$conn = mysqli_connect($server_name, $mysql_username, $mysql_password, $db_name);
if($conn)
{
	echo "";
}
else
{
	echo "Ooops !! No Connection !";
}
?>