<?php

// This will be used for connecting with database1 .

$db_name = "database1";
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