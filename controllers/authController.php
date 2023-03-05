<?php

// Security

class Auth
{
<<<<<<< HEAD

    //  CRSF Token
    public function csrf(): string
=======
    // Key for hash
    private string $key = '$My10k3n/S3cu4e.C0m';

    //  CRSF Token
    public function crsf(): string
>>>>>>> 3984657f22f101b62e546ba4d5f30f39f6cc37aa
    {

        try {

<<<<<<< HEAD
            $csrf = random_bytes(255);

            $_SESSION['csrf'] = bin2hex($csrf);

            return bin2hex($csrf);
=======
            $crsf = random_bytes(255);

            $_SESSION['crsf'] = bin2hex($crsf);

            return bin2hex($crsf);
>>>>>>> 3984657f22f101b62e546ba4d5f30f39f6cc37aa

        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }

    // ID Token
    public function createToken(): void
    {
        try {

<<<<<<< HEAD
            $token = password_hash($_ENV['HASH_KEY'], PASSWORD_DEFAULT);
=======
            $token = password_hash($this->key, PASSWORD_DEFAULT);
>>>>>>> 3984657f22f101b62e546ba4d5f30f39f6cc37aa

            setcookie(
                'TOKEN',
                $token,
                [
<<<<<<< HEAD
=======
                    'expires' => time() + 24 * 3600,
>>>>>>> 3984657f22f101b62e546ba4d5f30f39f6cc37aa
                    'secure' => true,
                    'httponly' => true,
                    'samesite' => 'strict'

                ]

            );
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

<<<<<<< HEAD

=======
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

            echo $e->getMessage();
        }
    }
>>>>>>> 3984657f22f101b62e546ba4d5f30f39f6cc37aa

}

