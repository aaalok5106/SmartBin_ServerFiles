<?php
require "connect.php";
$user_email = "aj"; //$_POST["email"]; 
$user_pass = "vxbm"; //$_POST["password"]; 
$mysql_qry = "select * from user_registration where email like '$user_email' ";

echo "".$mysql_qry."<br>";

$result = $conn->query($mysql_qry);

if($result->num_rows >0 )
{
		$row = $result->fetch_assoc();
		echo $row["password"]."<br>";
		
		$newPasswd = random_password(4);
		echo $newPasswd."<br>";
		
		$mysql_qry2 = "UPDATE user_registration SET password='$newPasswd' WHERE email='$user_email' ";
		if ($conn->query($mysql_qry2) === TRUE)
		{
			echo "You have successfully Resetted your password.<br>";
		}
		else
		{
			echo "Error in reseting password !!<br>";
		}		
	
}
else
{
	echo "Sorry! Input credentials are WRONG...
	Please Login with valid credentials!";
}



function random_password( $length = 8 ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*()-=+;:,.?";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
}

?>