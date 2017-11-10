<?php
require "conn.php";
require 'PHPMailerAutoload.php';

$user_name = $_POST["user_name"];

$query="insert into history_filled_bins select * from bin_location_filled where path_making_status='1'";
if($conn->query($query)==TRUE){
	
}else{
	echo "Data Insertion Error";
	//echo $conn->error;
}
$query1="delete from bin_location_filled where path_making_status='1'";
if($conn->query($query1)==TRUE){
	
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

		$mail->addAddress('praveen.cs15@iitp.ac.in');   // Add a recipient
		
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');


		$mail->isHTML(true);  // Set email format to HTML

		$bodyContent = '<h1>Garbage Collector e-mail by GarbageCollect App</h1>';
		$bodyContent .= "<p>This e-mail is as a notification send by Driver <b>( Username : ".$user_name." )</b> informing Admin that he has done the Garbage Collection</p>";
		$bodyContent .= "<br><br><br><br><p>Note : This mail does not ensure the intentional misuse of app by driver</p>";

		$mail->Subject = 'Email from GarbageCollect app regarding Garbage Collection';
		$mail->Body    = $bodyContent;

		if(!$mail->send()) {
			//echo 'Password cannot be resetted, Try again !';
			// no echo intentionally
		}
	
	
	echo "Flushing Done";
	
	
}else{
	echo "Data Could not be Flushed";
	//echo "Data Could not be Flushed" . " " .$conn->error;
}

?>