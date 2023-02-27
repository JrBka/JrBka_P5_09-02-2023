<?php
require 'vendor\autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

abstract class Mailer
{

    protected string $name;
    protected string $email;
    protected string $message;
    protected $mail;

    // PHP MAILER function
    public function sendMail(): void
    {
        $this->mail = new PHPMailer(true);

        try {
            //info debug
            //$this->>mail->SMTPDebug = SMTP::DEBUG_SERVER;

            //config smtp
            $this->mail->isSMTP();
            $this->mail->Host = 'localhost';
            $this->mail->Port = 1025;

            //charset
            $this->mail->CharSet = 'utf-8';

            //recipient
            $this->mail->addAddress('myblogpro@local.fr');

            //sender
            $this->mail->setFrom($this->name . $this->email);

            //content
            $this->mail->Subject = 'MyBlogPro';
            $this->mail->Body = $this->message;

            //send
            $this->mail->send();

            $_SESSION['Succes'] = "Message envoyé avec succès";

            header('Location:index.php#section-contact');

        } catch (Exception $e) {
            $_SESSION['Error'] = $e->getMessage();

            header('Location:index.php#section-contact');

        }
    }
}

;