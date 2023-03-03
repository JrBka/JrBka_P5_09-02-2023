<?php

require_once('models/database.php');

class Post extends Database
{

    public function createPost(): void
    {

        $this->getConnection();

        try {

            // Insert user in users table
            $query = "INSERT INTO posts (userId,content,title) VALUES (:userId,:content,:title)";

            $insertPost = $this->connection->prepare($query);
            $insertPost->execute(
                [
                    'userId' => $_SESSION['user']->id,
                    'title' => $_SESSION['post']->title,
                    'content' => $_SESSION['post']->content


                ]
            ) or throw new Exception();

        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }

    public function getAllPosts()
    {

        try {

            $this->getConnection();

            $query = "SELECT userId,postId,title,content,creationDate,lastModification,pseudo FROM posts INNER JOIN users WHERE posts.userId= users.id ORDER BY creationDate DESC ";
            $getPosts = $this->connection->prepare($query);
            $getPosts->execute() or throw new Exception();
            $fetchAll = $getPosts->fetchAll();

            if (is_bool($fetchAll) && !$fetchAll) {

                throw new Exception();

            } else {

                foreach ($fetchAll as $value) {

                    $_SESSION['posts'] [] = (object)$value;

                }

            }

        } catch (Exception $e) {

            $_SESSION['Error'] = $e->getMessage();
            header('Location:index.php?page=postspage');
        }

    }



}


