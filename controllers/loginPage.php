<?php
require_once('models/users.php');

class Login
{

    private string $name;
    private string $surname;
    private string $email;
    private string $pseudo;
    private string $pwd;


    public function getSignIn(): void
    {
        require('views/signInPage.php');
    }

    public function getSignUp(): void
    {
        require('views/signUpPage.php');
    }

    public function logout(): void
    {
        session_destroy();
        session_start();
        $_SESSION['destroy'] = 'Vous êtes déconnecté';
        header('Location:index.php');
    }

    public function signIn(): void
    {
        try {

            if ((isset($_POST['email']) && $_POST['email'] != "" && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) && (isset($_POST['pwd']) && $_POST['pwd'] != "")) {

                $loginValues = new Login();
                $loginValues->email = $_POST['email'];
                $loginValues->pwd = $_POST['pwd'];

                $password = $loginValues->pwd;

                $uppercase = preg_match('@[A-Z]@', $password);
                $lowercase = preg_match('@[a-z]@', $password);
                $number = preg_match('@[0-9]@', $password);
                $specialChars = preg_match('@[^\w]@', $password);

                if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
                    throw new Exception('Le mot de passe doit comporter au moins 8 caractères et doit inclure au moins une lettre majuscule, un chiffre et un caractère spécial.');
                } else {

                    $getUser = new Users();
                    $getUser->getUser();

                    if (isset($_SESSION['user'])) {
                        if ($loginValues->email === $_SESSION['user']['email'] && password_verify($loginValues->pwd, $_SESSION['user']['pwd'])) {
                            $_SESSION['firstConnexion'] = 'Bonjour ' . $_SESSION['user']['pseudo'] . ' !';

                            header('Location:index.php');
                        } else {
                            throw new Exception('Mot de passe ou email incorrect');
                        }
                    } else {
                        throw new Exception('Utilisateur introuvable');
                    }
                }
            } else {
                throw new Exception('Tous les champs sont requis et doivent être valide!');
            }

        } catch (Exception $e) {
            $_SESSION['signInError'] = $e->getMessage();
            header('Location:index.php?page=signin#section-signIn');
        }


    }

    public function signUp(): void
    {

        try {


            if ((isset($_POST['name']) && $_POST['name'] != "") && (isset($_POST['email']) && $_POST['email'] != "" && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) && (isset($_POST['surname']) && $_POST['surname'] != "") && (isset($_POST['pseudo']) && $_POST['pseudo'] != "") && (isset($_POST['pwd']) && $_POST['pwd'] != "")) {

                $signUpValues = new Login();
                $signUpValues->name = $_POST['name'];
                $signUpValues->surname = $_POST['surname'];
                $signUpValues->pseudo = $_POST['pseudo'];
                $signUpValues->email = $_POST['email'];
                $signUpValues->pwd = $_POST['pwd'];

                $password = $signUpValues->pwd;

                $uppercase = preg_match('@[A-Z]@', $password);
                $lowercase = preg_match('@[a-z]@', $password);
                $number = preg_match('@[0-9]@', $password);
                $specialChars = preg_match('@[^\w]@', $password);

                if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
                    throw new Exception('Le mot de passe doit comporter au moins 8 caractères et doit inclure au moins une lettre majuscule, un chiffre et un caractère spécial.');
                } else {

                    $signUpValues->pwd = password_hash($password, PASSWORD_DEFAULT);

                    $_SESSION['user'] = [
                        $signUpValues->name,
                        $signUpValues->surname,
                        $signUpValues->pseudo,
                        $signUpValues->email,
                        $signUpValues->pwd
                    ];

                    $createUser = new Users();
                    $createUser->createUser();

                    ///generer le token

                    ///

                    $_SESSION['userCreated'] = "Votre profil a bien été créé !";

                    $_SESSION['firstConnexion'] = 'Bonjour ' . $_SESSION['user'][2] . ' !';

                    header('Location:index.php');
                }

            } else {
                throw new Exception('Tous les champs sont requis et doivent être valide!');
            }
        } catch (Exception $error) {
            $_SESSION['signUpError'] = $error->getMessage();
            header('Location:index.php?page=signup#section-signUp');
        }

    }

}