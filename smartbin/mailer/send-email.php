<?php

//require 'class.phpmailer.php';
//$mail = new PHPMailer();
require 'PHPMailerAutoload.php';
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

$mail->setFrom('moolchandra@iitp.ac.in', 'moolchandra');
//$mail->addReplyTo('info@codexworld.com', 'Smart Bin Management');

$mail->addAddress('praveendhaked7@gmail.com');   // Add a recipient
//$mail->addAddress('avinash.cs15@iitp.ac.in');
$mail->addCC('praveen.cs15@iitp.ac.in');
//$mail->addBCC('bcc@example.com');

// Add attachments
//$mail->addAttachment('/var/tmp/file.tar.gz');
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg'); // Optional name

$mail->isHTML(true);  // Set email format to HTML

//$bodyContent = '<h1>Password Reset e-mail by Smart Bin Management System</h1>';
//$bodyContent .= '<p>This is a system generated email sent from localhost using PHP script by <b>Smart Bin Management</b></p>';
//$bodyContent .= "<p>Your new Password is <b>newPasswd </b></p>";
$bodyContent = '<h1>This is a system generated email sent from localhost using PHP script</h1>';
$mail->Subject = 'e-mail by Smart Bin Management System';
$mail->Body    = $bodyContent;

if(!$mail->send()) {
    //echo 'Message could not be sent';
	
	echo ' email cannot be sent ! Try resetting again !';
    //echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo " email have been sent to registered email-address";
}



/*

$mail = new PHPMailer;




$mail->isSMTP();
//$mail->isMail();

$mail->Mailer = 'smtp';
$mail->SMTPAuth = true;
$mail->Host = 'smtp.gmail.com'; // "ssl://smtp.gmail.com" didn't worked
//$mail->Port = 465;
//$mail->SMTPSecure = 'ssl';
// or try these settings (worked on XAMPP and WAMP):
 $mail->Port = 587;
 $mail->SMTPSecure = 'tls';


$mail->Username = "aaalok5106@gmail.com";
$mail->Password = "1234....";

$mail->IsHTML(true); // if you are going to send HTML formatted emails
$mail->SingleTo = true; // if you want to send a same email to multiple users. multiple emails will be sent one-by-one.

$mail->From = "aaalok5106@gmail.com";
$mail->FromName = "Mridul";

$mail->addAddress("sunnykumar5106@gmail.com","Sunny Kumar");
//$mail->addAddress("user.2@gmail.com","User 2");

//$mail->addCC("user.3@ymail.com","User 3");
//$mail->addBCC("user.4@in.com","User 4");

$mail->Subject = "Testing PHPMailer with localhost";
$mail->Body = "Hi,<br /><br />This system is working perfectly.";

if(!$mail->Send())
    echo "Message was not sent <br />PHPMailer Error: " . $mail->ErrorInfo;
else
    echo "Message has been sent";
*/
?>