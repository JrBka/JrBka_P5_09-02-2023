<?php

// Security

class Auth
{

    //  Create CSRF Token
    public function csrf():string
    {

        try {

            $csrf = random_bytes(255);


            $_SESSION['csrf'] = bin2hex($csrf);
            $_SESSION['csrf_time'] = time();

            return bin2hex($csrf);

        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }

    // Create ID Token and insert into a cookie
    public function createToken(): void
    {
        try {

            $token = password_hash($_ENV['HASH_KEY'], PASSWORD_DEFAULT);

            setcookie(
                'TOKEN',
                $token,
                [
                    'secure' => true,
                    'httponly' => true,
                    'samesite' => 'strict'

                ]

            );
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }



}

