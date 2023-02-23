<?php
session_start();
require 'C:\Users\jrr87\vendor\autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class HomePage
{


    private string $name;
    private string $email;
    private string $message;

    public function getHomePage()
    {
        require('views/homePage.php');
    }

    public function getMessage(): void
    {
        try {

            if ((isset($_POST['name']) && $_POST['name'] != "") && (isset($_POST['email']) && $_POST['email'] != "" && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) && (isset($_POST['message']) && $_POST['message'] != "")) {

                $messageForm = new HomePage();
                $messageForm->name = htmlspecialchars($_POST['name']);
                $messageForm->email = htmlspecialchars($_POST['email']);
                $messageForm->message = htmlspecialchars($_POST['message']);


                $mail = new PHPMailer(true);

                try {
                    //info debug
                    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;

                    //config smtp
                    $mail->isSMTP();
                    $mail->Host = 'localhost';
                    $mail->Port = 1025;

                    //charset
                    $mail->CharSet = 'utf-8';

                    //destinataire
                    $mail->addAddress('myblogpro@local.fr');

                    //expediteur
                    $mail->setFrom($messageForm->name . $messageForm->email);

                    //contenu
                    $mail->Subject = 'MyBlogPro';
                    $mail->Body = $messageForm->message;

                    //envoi
                    $mail->send();

                    $_SESSION['mailSucces'] = "Message envoyé avec succès";

                } catch (Exception) {
                    throw new Exception("Erreur lors de l'envoi du mail");
                }
                header('Location:index.php#section-contact');

            } else {
                throw new Exception('Echec de l\'envoi du message! Un ou plusieurs champs incorrect.');
            }
        } catch (Exception $error) {
            $_SESSION['homeFormError'] = $error->getMessage();

            header('Location:index.php#section-contact');

        }

    }
}

