<?php
require_once('databaseModel.php');

class User extends Database
{
    private int $amdin = 1;
    private int $visitor = 2;

    //User creation and registration in database
    public function createUser()
    {
        $this->getAllUsers();
        try {

            $this->getConnection();

            try {

                // Insert user in users table
                $sql1 = "INSERT INTO users (nom,prenom,pseudo,email,password) VALUES (:nom,:prenom,:pseudo,:email,:password)";

                $insertUserTable1 = $this->connection->prepare($sql1);
                $insertUserTable1->execute(
                    [
                        'nom' => $_SESSION['user']->name,
                        'prenom' => $_SESSION['user']->surname,
                        'pseudo' => $_SESSION['user']->pseudo,
                        'email' => $_SESSION['user']->email,
                        'password' => $_SESSION['user']->pwd

                    ]
                ) or throw new Exception();

            } catch (Exception $e) {
                echo $e->getMessage();
            }


            try {

                $pseudo = $_SESSION['user']->pseudo;

                // Get the new user's ID
                $sql2 = "SELECT id FROM users WHERE pseudo = ? ";
                $getId = $this->connection->prepare($sql2);
                $getId->execute([$pseudo]) or throw new Exception();
                $id = $getId->fetchObject();

            } catch (Exception $e) {
                echo $e->getMessage();
            }

            try {

                // Insert idUser and idRole in association table users_roles
                $sql3 = "INSERT INTO users_roles (idUser,idRole) Values (?,?)";
                $insertUserTable2 = $this->connection->prepare($sql3);
                $insertUserTable2->execute([
                    $id->id,
                    $this->visitor
                ]) or throw new Exception();

            } catch (Exception $e) {
                echo $e->getMessage();
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }

    //Get one user and his role
    public function getUser()
    {
        try {

            $this->getConnection();

            $query = "SELECT id,nom,prenom,pseudo,email,password,idRole FROM users INNER JOIN users_roles WHERE users.id = users_roles.idUser AND email = ?";
            $getId = $this->connection->prepare($query);
            $getId->execute([$_POST['email']]) or throw new Exception();
            $fetch = $getId->fetchObject();

            if (is_bool($fetch) && !$fetch) {

                throw new Exception('Utilisateur introuvable');

            } else {

                $_SESSION['user'] = $fetch;

            }

        } catch (Exception $e) {

            $_SESSION['Error'] = $e->getMessage();
            header('Location:index.php?page=signin#section-signIn');
        }

    }

    // Get all users in database and their roles
    public function getAllUsers()
    {
        try {

            $this->getConnection();

            $query = "SELECT id,nom,prenom,pseudo,email,password,idRole FROM users INNER JOIN users_roles WHERE users.id = users_roles.idUser";
            $getId = $this->connection->prepare($query);
            $getId->execute() or throw new Exception();
            $fetch = $getId->fetchAll();

            if (is_bool($fetch) && !$fetch) {

                throw new Exception();

            } else {

                foreach ($fetch as $value) {
                    if ($value['pseudo'] == $_SESSION['user']->pseudo) {

                        throw new Exception('Ce pseudo est déjà utilisé');

                    } elseif ($value['email'] == $_SESSION['user']->email) {

                        throw new Exception('Cet email est déjà utilisé');

                    }
                }
            }

        } catch (Exception $e) {
            unset($_SESSION['user']);
            $_SESSION['Error'] = $e->getMessage();
            header('Location:index.php?page=signup#section-signUp');
        }

    }

}

;


