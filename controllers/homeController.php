<?php
session_start();
$_SESSION['LOGGED_USER'] = false;


require_once('models/mailerModel.php');
require_once('controllers/authController.php');


class Home extends Mailer
{

    // Get homePage and check ID token if $_SESSION['user'] exists
    public function getHomePage(): void
    {
        if (isset($_SESSION['user'])) {

            $verifToken = new Auth();
            $verifToken->verifToken();

            require('views/homePage.php');

        } else {

            require('views/homePage.php');
        }
    }

    // Send email via PHP MAILER
    public function getMessage(): void
    {
        try {

            if (empty(trim($_POST['name'])) || empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || empty(trim($_POST['message']))) {

                $_SESSION['Error'] = 'Echec de l\'envoi du message! Un ou plusieurs champs incorrect.';

                header('Location:index.php#section-contact');
            } else {

                $form = new Home();
                $form->name = $_POST['name'];
                $form->email = $_POST['email'];
                $form->message = $_POST['message'];

                $form->sendMail();

            }
        } catch (Exception $error) {

            $_SESSION['Error'] = $error->getMessage();

            header('Location:index.php#section-contact');
        }

    }
}

;

