<?php
require "connect.php";

// Admin register php.

$email = $_POST["email"];
$name = $_POST["name"];
$mob_no = $_POST["mob_no"];
$password = hash('sha512' , $_POST["password"]);


$mysql_qry = "insert into user_registration (email, name, mob_no, password) values ('$email',
				'$name', '$mob_no', '$password')";

if($conn->query($mysql_qry) === TRUE)
{
	echo "Registration Successful...You can now Log In !";
}
else
{
	//echo "Error: " . $mysql_qry . "<br>" . $conn->error;
	echo "Error Inserting Registering Data...Maybe email already exists!!";
	
}
$conn->close() ;
?>