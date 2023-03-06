<?php
require_once('models/database.php');

class Comment extends Database
{

    // Insert comment in comments table
    public function createComment(string $commentContent): void
    {

        $this->getConnection();


            $query = "INSERT INTO comments (postId,userId,content) VALUES (:postId,:userId,:content)";

            $insertPost = $this->connection->prepare($query);
            $insertPost->execute(
                [
                    'userId' => $_SESSION['user']->id,
                    'postId' => $_SESSION['post']->postId,
                    'content' => $commentContent

                ]
            ) or throw new Exception();


    }


    // Get all posts in database
    public function getAllComments() :void
    {

            $this->getConnection();

            $query = "SELECT DISTINCT comments.userId,comments.postId,comments.commentId,comments.content,comments.creationDate,comments.lastModification,users.pseudo FROM comments INNER JOIN users ON comments.userId = users.id INNER JOIN posts WHERE comments.postId =  ? ORDER BY creationDate DESC ";
            $getComments = $this->connection->prepare($query);
            $getComments->execute([$_SESSION['post']->postId]) or throw new Exception();
            $fetchAll = $getComments->fetchAll();

            if (is_bool($fetchAll) && !$fetchAll) {

                throw new Exception();

            } else {

                foreach ($fetchAll as $value) {

                    $_SESSION['comments'] [] = (object)$value;
                }

            }

    }




}

