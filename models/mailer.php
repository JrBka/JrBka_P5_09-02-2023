<?php
require 'vendor\autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer
{

    protected mixed $mail;

    // PHP MAILER function
    public function sendMail( object $formContent): void
    {
        $this->mail = new PHPMailer(true);

        try {
            //info debug
            //$this->>mail->SMTPDebug = SMTP::DEBUG_SERVER;

            //config smtp
            $this->mail->isSMTP();
            $this->mail->Host = $_ENV['MAILER_HOST'];
            $this->mail->Port = $_ENV['MAILER_PORT'];

            //charset
            $this->mail->CharSet = 'utf-8';

            //recipient
            $this->mail->addAddress('myblogpro@local.fr');

            //sender
            $this->mail->setFrom($formContent->email);

            //content
            $this->mail->Subject = 'MyBlogPro';
            $this->mail->Body = $formContent->message;

            //send
            $this->mail->send();

            $_SESSION['Success'] = "Message envoyé avec succès";

            header('Location:index.php#section-contact');

        } catch (Exception $e) {
            $_SESSION['Error'] = $e->getMessage();

            header('Location:index.php#section-contact');

        }
    }
}

