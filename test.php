<?php

include_once __DIR__ . "/controllers/MailController.php";
include_once __DIR__ . "/mail.html";

$email = "rohanmaharjan012@gmail.com";
$username = "Rohan Mhz";


$mail = new MailController;
$subject = 'User Registered';
$body = "<h1>Hey there, you have registered a new account with the username: $username</h1>";
$mail->sendMail($email, $subject, $body);

echo "DONE";
?>