<?php
require_once('database.php');

class User extends Database
{
    const ADMIN = 1;
    const VISITOR = 2;

    //User creation and registration in database
    public function createUser($user): void
    {

            $this->getConnection();


                // Insert user in users table
                $sql1 = "INSERT INTO users (nom,prenom,pseudo,email,password) VALUES (:nom,:prenom,:pseudo,:email,:password)";

                $insertUserTable1 = $this->connection->prepare($sql1);
                $insertUserTable1->execute(
                    [
                        'nom' => $user->name,
                        'prenom' => $user->surname,
                        'pseudo' => $user->pseudo,
                        'email' => $user->email,
                        'password' => $user->pwd

                    ]
                ) or throw new Exception();


                // Get the new user's ID
                $sql2 = "SELECT id FROM users WHERE pseudo = ? ";
                $getId = $this->connection->prepare($sql2);
                $getId->execute([$user->pseudo]) or throw new Exception();
                $id = $getId->fetchObject();


                // Insert idUser and idRole in association table users_roles
                $sql3 = "INSERT INTO users_roles (idUser,idRole) Values (?,?)";
                $insertUserTable2 = $this->connection->prepare($sql3);
                $insertUserTable2->execute([
                    $id->id,
                    self::VISITOR
                ]) or throw new Exception();

    }


    //Get one user and his role
    public function getUser($email): mixed
    {

            $this->getConnection();

            $query = "SELECT id,nom,prenom,pseudo,email,password,idRole FROM users INNER JOIN users_roles WHERE users.id = users_roles.idUser AND email = ?";
            $getId = $this->connection->prepare($query);
            $getId->execute([$email]) or throw new Exception();
            $fetch = $getId->fetchObject();

            return $fetch;

    }

    // Get all users in database and their roles
    public function getAllUsers(): mixed
    {

            $this->getConnection();

            $query = "SELECT id,nom,prenom,pseudo,email,password,idRole FROM users INNER JOIN users_roles WHERE users.id = users_roles.idUser";
            $getId = $this->connection->prepare($query);
            $getId->execute() or throw new Exception();
            $fetch = $getId->fetchAll();

            return $fetch;

    }

}




