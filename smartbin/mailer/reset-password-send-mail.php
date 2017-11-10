<?php
require 'PHPMailerAutoload.php';
require "connect.php";

$user_email = $_POST["email"];
//$user_email = "praveendhaked7@gmail.com"; 

$mysql_qry = "select * from user_registration where email like '$user_email' ";

$result = $conn->query($mysql_qry);

if($result->num_rows >0 )
{
	$row = $result->fetch_assoc();
		
	$newPasswd = random_password(8);
		
	if( $row['email'] === $user_email )
	{	

		$mail = new PHPMailer;
		
		$mail->isSMTP();                          // Set mailer to use SMTP
		$mail->Host = 'chanakya.iitp.ac.in';             // Specify main and backup SMTP servers
		//$mail->SMTPAuth = false;                     // Enable SMTP authentication
		$mail->Username = 'moolchandra@iitp.ac.in';          // SMTP username
		$mail->Password = '1234'; // SMTP password
		//$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
		//$mail->Port = 587;                          // TCP port to connect to
		//$mail->Port = 000;
		//$mail->SMTPSecure = '';
		

/*		$mail->isSMTP();                            // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                     // Enable SMTP authentication
		$mail->Username = 'aaalok5106@gmail.com';          // SMTP username
		$mail->Password = '1234'; // SMTP password	( password is wrong :)
		$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                          // TCP port to connect to
		//$mail->Port = 465;
		//$mail->SMTPSecure = 'ssl';
*/



		$mail->setFrom('aaalok5106@gmail.com', 'Smart Bin Management');
		//$mail->addReplyTo('info@codexworld.com', 'Smart Bin Management');

		//$mail->addAddress('praveendhaked7@gmail.com');   // Add a recipient
		$mail->addAddress($user_email);
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		// Add attachments
		//$mail->addAttachment('/var/tmp/file.tar.gz');
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg'); // Optional name

		$mail->isHTML(true);  // Set email format to HTML

		$bodyContent = '<h1>Password Reset e-mail by Smart Bin Management System</h1>';
		$bodyContent .= '<p>This is a Automatic system generated email sent by <b>Smart Bin Management System</b></p>';
		$bodyContent .= "<p>Your new Password is <b>".$newPasswd." </b></p>";

		$mail->Subject = 'Email by Smart Bin Management System';
		$mail->Body    = $bodyContent;

		if(!$mail->send()) {
			echo 'Password cannot be resetted, Try again !';
			
		} else {
			// start inserting resetted password into database.
			$new_password = hash('sha512' , '$newPasswd');
			$mysql_qry2 = "UPDATE user_registration SET password='$new_password' WHERE email='$user_email' ";
			if ($conn->query($mysql_qry2) === TRUE){
				echo "Password successfully resetted and sent to your registered email-address";
			}else echo 'Database insertion ERROR ! Ignore email sent !';
		}

	}else {
		//echo "Error in reseting password in database!!";
		// don't CARE !!!
	}			
}
else {
	echo "Sorry!! Entered e-mail cannot be found in database!!";
}



function random_password( $length = 8 ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*()-=+;:,.?";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
}



?>