<?php

abstract class Database
{

    protected mixed $connection;

    // Database connection with PDO
    public function __CONSTRUCT()
    {
        $this->connection = null;

        try {

            $this->connection = new PDO('mysql:host=' . $_ENV['DB_HOST'] . ':' . $_ENV['DB_PORT'] . ';dbname=' . $_ENV['DB_NAME'], $_ENV['DB_USERNAME'], $_ENV['DB_PWD'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        } catch (PDOException $e) {

            echo $e->getMessage();

        }
    }
}



