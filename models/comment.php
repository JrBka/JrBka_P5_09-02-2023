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


    // Get all comments validated for each post in database
    public function getComments() :void
    {

            $this->getConnection();

            $query = "SELECT DISTINCT comments.userId,comments.postId,comments.commentId,comments.content,comments.creationDate,comments.lastModification,users.pseudo FROM comments INNER JOIN users ON comments.userId = users.id INNER JOIN posts WHERE comments.postId =  ? AND comments.is_validate = 1 ORDER BY creationDate DESC ";
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


    // Get all comments invalidated in database
    public function getAllComments() :void
    {

        $this->getConnection();

        $query = "SELECT comments.userId,comments.postId,comments.commentId,comments.content,comments.creationDate,comments.lastModification,users.pseudo FROM comments INNER JOIN users ON comments.userId = users.id AND comments.is_validate = 0 ORDER BY creationDate DESC ";
        $getAllComments = $this->connection->prepare($query);
        $getAllComments->execute() or throw new Exception();
        $fetchAll = $getAllComments->fetchAll();

        if (is_bool($fetchAll) && !$fetchAll) {

            throw new Exception();

        } else {

            foreach ($fetchAll as $value) {

                $_SESSION['comments'] [] = (object)$value;
            }

        }

    }


    // Update Comment
    public function updateComment($commentId):void{

        $this->getConnection();



        $query = "UPDATE comments SET is_validate = :is_validate WHERE commentId = :commentId";

        $updatePost = $this->connection->prepare($query);
        $updatePost->execute(
            [
                'is_validate' => 1,
                'commentId' => $commentId


            ]
        ) or throw new Exception();

    }


    // Delete comment
    public function deleteComment($commentId):void{

        $this->getConnection();


        $query = "DELETE FROM comments WHERE commentId = :commentId";

        $insertPost = $this->connection->prepare($query);
        $insertPost->execute(
            [
                'commentId'=>$commentId
            ]
        ) or throw new Exception();


    }

}

