<?php

// Security

class Auth
{

    //  CRSF Token
    public function csrf(): string
    {

        try {

            $csrf = random_bytes(255);

            $_SESSION['csrf'] = bin2hex($csrf);

            return bin2hex($csrf);

        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }

    // ID Token
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

