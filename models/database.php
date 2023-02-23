<?php

abstract class Database
{

    private string $host = 'localhost';
    private string $port = '3307';
    private string $dbName = 'myblogpro';
    private string $username = 'root';
    private string $password = '';

    protected $connection;

    public function getConnection()
    {
        $this->connection = null;

        try {
            $this->connection = new PDO('mysql:host=' . $this->host . ':' . $this->port . ';dbname=' . $this->dbName, $this->username, $this->password);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}

