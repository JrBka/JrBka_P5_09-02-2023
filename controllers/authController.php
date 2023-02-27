<?php

// Security

class Auth
{
    // Key for hash
    private string $key = '$My10k3n/S3cu4e.C0m';

    //  CRSF Token
    public function crsf()
    {

        try {

            $crsf = random_bytes(255);

            $_SESSION['crsf'] = bin2hex($crsf);

            return $crsf;

        } catch (Exception $e) {
            die($e->getMessage());
        }

    }

    // ID Token
    public function createToken(): void
    {
        try {

            $token = password_hash($this->key, PASSWORD_DEFAULT);

            setcookie(
                'TOKEN',
                $token,
                [
                    'expires' => time() + 24 * 3600,
                    'secure' => true,
                    'httponly' => true,
                    'samesite' => 'strict'

                ]

            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Check ID token
    public function verifToken(): void
    {
        try {

            if (empty($_COOKIE['TOKEN']) || !password_verify($this->key, $_COOKIE['TOKEN'])) {

                setcookie('TOKEN');
                session_destroy();

                session_start();
                $_SESSION['TokenError'] = true;

                header('Location:index.php');

            } else {
                $_SESSION['LOGGED_USER'] = true;

            }

        } catch (Exception $e) {

            die($e->getMessage());
        }
    }

}