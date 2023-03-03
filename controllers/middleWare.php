<?php


class MiddleWare
{
    // Check ID token
    public function checkToken(): void
    {
        try {
            if (isset($_SESSION['user'])) {

                if (empty($_COOKIE['TOKEN']) || !password_verify($_ENV['HASH_KEY'], $_COOKIE['TOKEN'])) {

                    setcookie('TOKEN');
                    session_destroy();

                    session_start();
                    $_SESSION['tokenError'] = true;

                    header('Location:index.php');

                }
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // Check activity
    public function checkInactivity():void{

        $maxInactivity = time() - 1800;
        try {

            if (isset($_SESSION)){
                if (!isset($_SESSION['time'])){
                    $_SESSION['time'] = time();
                }elseif ($_SESSION['time'] < $maxInactivity){
                    setcookie('TOKEN');
                    session_destroy();

                    session_start();
                    $_SESSION['tokenError'] = true;

                    header('Location:index.php');

                }else{
                    $_SESSION['time'] = time();
                }
            }

        }catch (Exception $e) {
            echo $e->getMessage();
        }
    }


}

