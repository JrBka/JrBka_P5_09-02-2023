<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer
{

    protected mixed $mail;

    // PHP MAILER function
    public function sendMail( object $formContent): bool
    {
        $this->mail = new PHPMailer(true);


            //info debug
            //$this->>mail->SMTPDebug = SMTP::DEBUG_SERVER;

            //config smtp
            $this->mail->isSMTP();
            $this->mail->Host = $_ENV['MAILER_HOST'];
            $this->mail->Port = $_ENV['MAILER_PORT'];

            //charset
            $this->mail->CharSet = 'utf-8';

            //recipient
            $this->mail->addAddress($_ENV['MAILER_RECIPIENT']);

            //sender
            $this->mail->setFrom($formContent->email);

            //content
            $this->mail->Subject = 'MyBlogPro';
            $this->mail->Body = $formContent->message;

            //send
            $this->mail->send();

            return true;


    }
}

