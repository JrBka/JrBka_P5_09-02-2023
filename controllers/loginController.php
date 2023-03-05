<?php
<<<<<<< HEAD
require_once('models/user.php');
=======
require_once('models/userModel.php');
>>>>>>> 3984657f22f101b62e546ba4d5f30f39f6cc37aa
require_once('controllers/authController.php');

class Login
{

    private string $name;
    private string $surname;
    private string $email;
    private string $pseudo;
    private string $pwd;


    public function getSignInPage(): void
    {
        require('views/signInPage.php');
    }

    public function getSignUpPage(): void
    {
        require('views/signUpPage.php');
    }

    public function logout(): void
    {
        session_destroy();
        setcookie('TOKEN');
        session_start();

        $_SESSION['destroy'] = true;
        header('Location:index.php');
    }

<<<<<<< HEAD
    // Account connection, check CSRF token in form
    public function signIn(): void
    {
        try {
            if (empty($_SESSION['csrf']) || empty($_POST['csrf']) || $_SESSION['csrf'] != $_POST['csrf']) {

                throw new Exception('Le token csrf n\'a pas pu être authentifié ');
=======
    // Account connection, check CRSF token in form
    public function signIn(): void
    {
        try {
            if (empty($_SESSION['crsf']) || empty($_POST['crsf']) || $_SESSION['crsf'] != $_POST['crsf']) {

                throw new Exception('Le token n\'a pas pu être authentifié ');
>>>>>>> 3984657f22f101b62e546ba4d5f30f39f6cc37aa
            } else {

                if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || empty($_POST['pwd'])) {

                    throw new Exception('Tous les champs sont requis et doivent être valide!');

                } else {

                    $loginValues = new Login();
                    $loginValues->email = $_POST['email'];
                    $loginValues->pwd = $_POST['pwd'];

                    $uppercase = preg_match('@[A-Z]@', $loginValues->pwd);
                    $lowercase = preg_match('@[a-z]@', $loginValues->pwd);
                    $number = preg_match('@[0-9]@', $loginValues->pwd);
                    $specialChars = preg_match('@[^\w]@', $loginValues->pwd);

                    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($loginValues->pwd) < 8) {

                        throw new Exception('Le mot de passe doit comporter au moins 8 caractères et doit inclure au moins une lettre majuscule, un chiffre et un caractère spécial.');

                    } else {

                        $getUser = new User();
<<<<<<< HEAD
                        $user = $getUser->getUser($loginValues->email);

                        if (empty($user)) {
=======
                        $getUser->getUser();

                        if (!isset($_SESSION['user'])) {
>>>>>>> 3984657f22f101b62e546ba4d5f30f39f6cc37aa

                            throw new Exception('Utilisateur introuvable');

                        } else {
<<<<<<< HEAD
                            if (!password_verify($loginValues->pwd, $user->password)) {

=======
                            if ($loginValues->email != $_SESSION['user']->email || !password_verify($loginValues->pwd, $_SESSION['user']->password)) {

                                unset($_SESSION['user']);
>>>>>>> 3984657f22f101b62e546ba4d5f30f39f6cc37aa
                                throw new Exception('Mot de passe ou email incorrect');

                            } else {

<<<<<<< HEAD
                                $_SESSION['user']=$user;

                                $createToken = new Auth();
                                $createToken->createToken();
                                
=======
                                $createToken = new Auth();
                                $createToken->createToken();


>>>>>>> 3984657f22f101b62e546ba4d5f30f39f6cc37aa
                                $_SESSION['atConnection'] = true;

                                header('Location:index.php');
                            }
                        }
                    }

                }
            }
        } catch (Exception $e) {
            $_SESSION['Error'] = $e->getMessage();
            header('Location:index.php?page=signin#section-signIn');
        }

<<<<<<< HEAD
=======

>>>>>>> 3984657f22f101b62e546ba4d5f30f39f6cc37aa
    }

    // Account creation
    public function signUp(): void
    {

        try {

            if (empty($_POST['name']) || empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || empty($_POST['pwd']) || empty($_POST['surname']) || empty($_POST['pseudo'])) {

                throw new Exception('Tous les champs sont requis et doivent être valide!');

            } else {

                $signUpValues = new Login();
                $signUpValues->name = $_POST['name'];
                $signUpValues->surname = $_POST['surname'];
                $signUpValues->pseudo = $_POST['pseudo'];
                $signUpValues->email = $_POST['email'];
                $signUpValues->pwd = $_POST['pwd'];


                $uppercase = preg_match('@[A-Z]@', $signUpValues->pwd);
                $lowercase = preg_match('@[a-z]@', $signUpValues->pwd);
                $number = preg_match('@[0-9]@', $signUpValues->pwd);
                $specialChars = preg_match('@[^\w]@', $signUpValues->pwd);

                if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($signUpValues->pwd) < 8) {

                    throw new Exception('Le mot de passe doit comporter au moins 8 caractères et doit inclure au moins une lettre majuscule, un chiffre et un caractère spécial.');

                } else {

                    $signUpValues->pwd = password_hash($signUpValues->pwd, PASSWORD_DEFAULT);

<<<<<<< HEAD
                    $user = (object)[
=======
                    $_SESSION['user'] = (object)[
>>>>>>> 3984657f22f101b62e546ba4d5f30f39f6cc37aa
                        'name' => $signUpValues->name,
                        'surname' => $signUpValues->surname,
                        'pseudo' => $signUpValues->pseudo,
                        'email' => $signUpValues->email,
                        'pwd' => $signUpValues->pwd
                    ];

<<<<<<< HEAD
                    $users = new User();
                    $allUsers = $users->getAllUsers();

                    foreach ($allUsers as $value) {
                        if ($value['pseudo'] == $user->pseudo) {

                            throw new Exception('Ce pseudo est déjà utilisé');

                        } elseif ($value['email'] == $user->email) {

                            throw new Exception('Cet email est déjà utilisé');

                        }
                    }


                    $users->createUser($user);

                    $_SESSION['user'] = $user;
=======
                    $createUser = new User();
                    $createUser->createUser();
>>>>>>> 3984657f22f101b62e546ba4d5f30f39f6cc37aa

                    $createToken = new Auth();
                    $createToken->createToken();

                    $_SESSION['userCreated'] = true;

                    $_SESSION['atConnection'] = true;


                    header('Location:index.php');
                }
            }

        } catch (Exception $error) {
            $_SESSION['Error'] = $error->getMessage();
            header('Location:index.php?page=signup#section-signUp');
        }

    }

}

