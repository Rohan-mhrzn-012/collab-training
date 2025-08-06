<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../bootstrap.php';


class MailController {
    private $mailer;

    public function __construct() {

        $this->mailer = new PHPMailer(true);
        $this->setup();
    }

    private function setup() {
        $this->mailer->isSMTP();
        $this->mailer->Host = $_ENV['MAIL_HOST'];
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = $_ENV['MAIL_USERNAME'];
        $this->mailer->Password = $_ENV['MAIL_PASSWORD'];
        $this->mailer->SMTPSecure = $_ENV['MAIL_ENCRYPTION'] ?? 'tls';
        $this->mailer->Port = $_ENV['MAIL_PORT'];
        $this->mailer->setFrom($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_FROM_NAME']);
    }

    public function sendMail($to, $subject, $body) {
        try {
            $this->mailer->addAddress($to);
            $this->mailer->isHTML(true);
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $body;

            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            var_dump($this->mailer->ErrorInfo);
            error_log("Mail Error: " . $this->mailer->ErrorInfo);
            return false;
        }
    }
}
