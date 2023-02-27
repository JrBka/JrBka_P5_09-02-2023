<?php

abstract class Database
{

    private string $host = 'localhost';
    private string $port = '3307';
    private string $dbName = 'myblogpro';
    private string $username = 'root';
    private string $password = '';

    protected $connection;

    // Database connection with PDO
    public function getConnection(): void
    {
        $this->connection = null;

        try {

            $this->connection = new PDO('mysql:host=' . $this->host . ':' . $this->port . ';dbname=' . $this->dbName, $this->username, $this->password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        } catch (PDOException $e) {

            echo $e->getMessage();

        }
    }
}



