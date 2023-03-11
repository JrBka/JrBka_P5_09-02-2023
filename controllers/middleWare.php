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

                  throw new Exception('<h1 style="text-align: center; margin-top: 50vh;font-size: xxx-large">Vous n\'avez pas l\'autorisation d\'accéder à cette page !</h1>');
                }

        } catch (Exception $e) {
            echo( $e->getMessage());
            exit();
        }
    }


    // Check csrf token
    public function checkCsrfToken():void
    {
        try {

        if (empty($_SESSION['csrf']) || empty($_POST['csrf']) || $_SESSION['csrf'] != $_POST['csrf']) {

            throw new Exception('Le token csrf n\'a pas pu être authentifié !');

        } elseif ($_SESSION['csrf_time'] < time() - 300) {

            throw new Exception('Le token csrf à expiré !');

        }

        } catch (Exception $e) {

            $url = $_SERVER['HTTP_REFERER'];
            $_SESSION['Error'] = $e->getMessage();
            header('Location:'.$url.'#section-error-success');
            exit();

        }
    }


}

