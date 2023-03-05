<?php
session_start();
<<<<<<< HEAD

require_once('models/mailer.php');

class Home
=======
$_SESSION['LOGGED_USER'] = false;


require_once('models/mailerModel.php');
require_once('controllers/authController.php');


class Home extends Mailer
>>>>>>> 3984657f22f101b62e546ba4d5f30f39f6cc37aa
{

    // Get homePage and check ID token if $_SESSION['user'] exists
    public function getHomePage(): void
    {
<<<<<<< HEAD

            require('views/homePage.php');

=======
        if (isset($_SESSION['user'])) {

            $verifToken = new Auth();
            $verifToken->verifToken();

            require('views/homePage.php');

        } else {

            require('views/homePage.php');
        }
>>>>>>> 3984657f22f101b62e546ba4d5f30f39f6cc37aa
    }

    // Send email via PHP MAILER
    public function getMessage(): void
    {
        try {

            if (empty(trim($_POST['name'])) || empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || empty(trim($_POST['message']))) {

                $_SESSION['Error'] = 'Echec de l\'envoi du message! Un ou plusieurs champs incorrect.';

                header('Location:index.php#section-contact');
            } else {

<<<<<<< HEAD
                $form = new Mailer();
                $formContent = (object)[
                    'name'=>$_POST['name'],
                    'email' => $_POST['email'],
                    'message' => $_POST['message']
                ];

                $form->sendMail($formContent);
=======
                $form = new Home();
                $form->name = $_POST['name'];
                $form->email = $_POST['email'];
                $form->message = $_POST['message'];

                $form->sendMail();
>>>>>>> 3984657f22f101b62e546ba4d5f30f39f6cc37aa

            }
        } catch (Exception $error) {

            $_SESSION['Error'] = $error->getMessage();

            header('Location:index.php#section-contact');
        }

    }
}



