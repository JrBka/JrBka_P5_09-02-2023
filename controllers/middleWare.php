<?php

// Security

class MiddleWare
{
    // Check ID token
    public function checkSessionToken(): void
    {
        try {
            if (isset($_SESSION['user'])) {

                if (empty($_COOKIE['TOKEN']) || !password_verify($_ENV['HASH_KEY'], $_COOKIE['TOKEN'])) {

                    setcookie('TOKEN');
                    session_destroy();

                    session_start();
                    $_SESSION['tokenError'] = true;

                    header('Location:index.php?page=homepage');

                }
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // Check activity
    public function checkInactivity():void{

        $maxInactivity = time() - 3600;
        try {

            if (isset($_SESSION)){

                if (!isset($_SESSION['time'])){

                    $_SESSION['time'] = time();

                }elseif ($_SESSION['time'] < $maxInactivity){

                    setcookie('TOKEN');
                    session_destroy();

                    session_start();
                    $_SESSION['tokenError'] = true;

                    header('Location:index.php?page=homepage');

                }else{
                    $_SESSION['time'] = time();
                }
            }

        }catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    // Check role
    public function checkRole():void
    {

        try {

                if (empty($_SESSION['user']) || $_SESSION['user']->idRole !== 1){

                    $_SESSION['Display'] = false;

                }else{
                    $_SESSION['Display'] = true;
                }

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    // Check csrf token
    public function checkCsrfToken():bool
    {
        try {

        if (empty($_SESSION['csrf']) || empty($_POST['csrf']) || $_SESSION['csrf'] != $_POST['csrf']) {

            throw new Exception('Le token csrf n\'a pas pu être authentifié !');

        } elseif ($_SESSION['csrf_time'] < time() - 10) {

           throw new Exception('Le token csrf à expiré !');

        }else {return true;}

        } catch (Exception $e) {

            $_SESSION['Error'] = $e->getMessage();
            return false;

        }
    }


}

