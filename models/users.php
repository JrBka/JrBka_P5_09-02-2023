<?php
require_once('database.php');

class Users extends Database
{

    public function createUser()
    {
        try {
            $this->getConnection();

            try {

                $sql1 = "INSERT INTO users (nom,prenom,pseudo,email,password) VALUES (:nom,:prenom,:pseudo,:email,:password)";

                $insertUser1 = $this->connection->prepare($sql1);
                $insertUser1->execute(
                    [
                        'nom' => $_SESSION['user'][0],
                        'prenom' => $_SESSION['user'][1],
                        'pseudo' => $_SESSION['user'][2],
                        'email' => $_SESSION['user'][3],
                        'password' => $_SESSION['user'][4]

                    ]
                ) or throw new Exception();
            } catch (Exception $e) {
                die($e->getMessage());
            }

            try {
                $pseudo = $_SESSION['user'][2];
                $sql2 = "SELECT id FROM users WHERE pseudo = ? ";
                $getId = $this->connection->prepare($sql2);
                $getId->execute([$pseudo]) or throw new Exception();
                $id = $getId->fetch();
            } catch (Exception $e) {
                die($e->getMessage());
            }

            try {
                $sql3 = "INSERT INTO users_roles (idUser,idRole) Values (?,?)";
                $insertUser2 = $this->connection->prepare($sql3);
                $insertUser2->execute([
                    $id[0],
                    2
                ]) or throw new Exception();
            } catch (Exception $e) {
                die($e->getMessage());
            }

        } catch (Exception $e) {
            echo die($e->getMessage());
        }

    }

    public function getUser()
    {
        try {
            $this->getConnection();


            $query = "SELECT * FROM users WHERE email = ?";
            $getId = $this->connection->prepare($query);
            $getId->execute([$_POST['email']]) or throw new Exception();
            $getId = $getId->fetch();
            if ($getId) {
                $_SESSION['user'] = [
                    'id' => $getId[0],
                    'pseudo' => $getId[1],
                    'email' => $getId[2],
                    'pwd' => $getId[3],
                    'nom' => $getId[4],
                    'prenom' => $getId[5]
                ];
            } else {
                throw new Exception('Connexion échoué');
            }


        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }
}
