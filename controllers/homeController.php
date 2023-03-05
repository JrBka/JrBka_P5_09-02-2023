<?php
session_start();

require_once('models/mailer.php');



class Home
{

    // Get homePage
    public function getHomePage(): void
    {

            require('views/homePage.php');

    }

    // Send email via PHP MAILER
    public function getMessage(): void
    {
        try {

            if (empty(trim($_POST['name'])) || empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || empty(trim($_POST['message']))) {

                $_SESSION['Error'] = 'Echec de l\'envoi du message! Un ou plusieurs champs incorrect.';

                header('Location:index.php#section-contact');
            } else {

                $form = new Mailer();
                $formContent = (object)[
                    'name'=>$_POST['name'],
                    'email' => $_POST['email'],
                    'message' => $_POST['message']
                ];

                $form->sendMail($formContent);

            }
        } catch (Exception $error) {

            $_SESSION['Error'] = $error->getMessage();

            header('Location:index.php#section-contact');
        }

    }
}



