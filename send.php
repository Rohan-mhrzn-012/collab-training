<?php
require __DIR__ .'/../collab-training/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['mail']);
    $phone = htmlspecialchars($_POST['pno']);
    $message = nl2br(htmlspecialchars($_POST['message']));

    $mail->isSMTP();
    $mail->Host       = 'sandbox.smtp.mailtrap.io';
    $mail->SMTPAuth   = true;
    $mail->Username   = '589cb2d5af363c';
    $mail->Password   = 'dfcf4998a2c075';
    $mail->Port       = 2525;

    $mail->setFrom('no-reply@yourdomain.com', 'Website Contact');

    $mail->addAddress('professionalskill6@gmail.com', 'Admin');

    $mail->isHTML(true);
    $mail->Subject = 'New Contact Form Submission';
    $mail->Body    = "
      <h2>New Contact Message</h2>
      <p><strong>Name:</strong> {$name}</p>
      <p><strong>Email:</strong> {$email}</p>
      <p><strong>Phone:</strong> {$phone}</p>
      <p><strong>Message:</strong><br>{$message}</p>
    ";

    $mail->AltBody = "Name: $name\nEmail: $email\nPhone: $phone\nMessage:\n" . strip_tags($message);

    $mail->send();
    echo ("Message sent successfully!") ;
} catch (Exception $e) {
    echo "Mailer Error: {$mail->ErrorInfo}";
}
