<?php
require "connect.php"; // database1 connection.

// Admin Change-Password.

$user_email = $_POST["email"];
$old_passwd = $_POST["oldPassword"];
$new_passwd = $_POST["newPassword"];

//$user_email = "guyguy";
//$old_passwd = "qwertyuiol";
//$new_passwd = "000000";

$qry = " SELECT * FROM user_registration WHERE email LIKE '$user_email' ";
$result = $conn->query($qry);
if($result->num_rows>0)
{
	$row = $result->fetch_assoc();
	if( $row['password'] === $old_passwd )
	{
		$qry2 = " UPDATE user_registration SET password='$new_passwd' WHERE email='$user_email' ";
		if($conn->query($qry2) === TRUE)
		{
			echo 'Password successfully changed'; // it will be used mainly.
			
		}else echo 'Database insertion ERROR !';
	}else echo 'Your OLD password do not match'; // it will be used mainly.
}
else echo 'Email not found in database';
?>