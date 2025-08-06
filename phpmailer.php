<?php

use Psr\Log\LoggerInterface;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// require 'vendor/autoload.php';
require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

// Create Dotenv instance and load .env values
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

try {
    // Server settings  
    
    $phpmailer = new PHPMailer();
    $phpmailer->isSMTP();
    $phpmailer->Host = $_ENV["MAIL_HOST"];
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = $_ENV["MAIL_PORT"];
    $phpmailer->Username = $_ENV["MAIL_USERNAME"];
    $phpmailer->Password = $_ENV["MAIL_PASSWORD"];

    // Sender and recipient
    $phpmailer->setFrom('mdhr@yahoo.com', 'Pradeep Manandhar');
    $phpmailer->addAddress('barahi@yahoo.com', 'Ajay Bhayadyo');

    // Email content
    $phpmailer->isHTML(true);
    $phpmailer->Subject = 'Changu nam xu kha';
    $phpmailer->Body    = '<h1>Ji chahi Pradeep</h1><p>Chu yana cho nau.</p>';
    $phpmailer->AltBody = 'This is a plain text version for non-HTML email clients.';

    // Send email
    $phpmailer->send();
    echo "Email sent successfully to Mailtrap!";
} catch (Exception $e) {
    echo "Email could not be sent. Error: {$phpmailer->ErrorInfo}";
}
