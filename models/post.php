<?php

require_once('models/database.php');

class Post extends Database
{

    // Insert post in posts table
    public function createPost(): void
    {
            $query = "INSERT INTO posts (userId,content,title,chapo) VALUES (:userId,:content,:title,:chapo)";

            $insertPost = $this->connection->prepare($query);
            $insertPost->execute(
                [
                    'userId' => $_SESSION['user']->id,
                    'title' => $_SESSION['post']->title,
                    'chapo' => $_SESSION['post']->chapo,
                    'content' => $_SESSION['post']->content

                ]
            ) or throw new Exception();
    }


    public function getValidatedPosts():void
    {
         $this->getAllPosts(['is_validate' => 1]);
    }


    public function getInvalidatedPosts():void
    {
         $this->getAllPosts(['is_validate' => 0]);
    }



    public function getAllPosts(array $conditions):void
    {

        $query = "SELECT userId,postId,title,content,chapo,creationDate,lastModification,pseudo,author FROM posts INNER JOIN users WHERE posts.userId = users.id AND posts.is_validate = :is_validate ORDER BY creationDate DESC ";
        $getPosts = $this->connection->prepare($query);

        $getPosts->execute($conditions) or throw new Exception();
        $fetchAll = $getPosts->fetchAll();

        if (is_bool($fetchAll) && !$fetchAll) {
            throw new Exception();
        } else {
            foreach ($fetchAll as $value) {
                $_SESSION['posts'] [] = (object)$value;
            }
        }
    }



    // Get one post in database
    public function getPost():void
    {
            $query = "SELECT userId,postId,title,chapo,content,creationDate,lastModification,pseudo,author FROM posts INNER JOIN users WHERE posts.userId= users.id AND postId = :postId";
            $getPost = $this->connection->prepare($query);
            $getPost->execute(  ['postId' => $_SESSION['post']->postId]) or throw new Exception();
            $fetch = $getPost->fetchObject();

            if (is_bool($fetch) && !$fetch) {

                throw new Exception();

            } else {

                    $_SESSION['post'] = (object)$fetch;
            }
    }

    // Update post
    public function updatePost( object $formUpdateContent):void
    {
            $query = "UPDATE posts SET content = :content, title = :title, chapo = :chapo, author = :author, lastModification = :lastModification, is_validate = :is_validate WHERE postId = :postId";

            $updatePost = $this->connection->prepare($query);
            $updatePost->execute(
                [
                    'postId' => $formUpdateContent->postId,
                    'title' => $formUpdateContent->title,
                    'content' => $formUpdateContent->content,
                    'chapo' => $formUpdateContent->chapo,
                    'author' => $formUpdateContent->author,
                    'lastModification' => $formUpdateContent->lastModification,
                    'is_validate' => $formUpdateContent->is_validate
                ]
            ) or throw new Exception();
    }


    // Validation post
    public function validatePost(int $postId):void
    {
        $query = "UPDATE posts SET is_validate = :is_validate WHERE postId = :postId";

        $updatePost = $this->connection->prepare($query);
        $updatePost->execute(
            [
                'is_validate' => 1,
                'postId' => $postId
            ]
        ) or throw new Exception();
    }


    // Delete post
    public function deletePost(int $postId):void
    {
            $query = "DELETE FROM posts WHERE postId = :postId";

            $insertPost = $this->connection->prepare($query);
            $insertPost->execute(
                [
                    'postId' => $postId
                ]
            ) or throw new Exception();
    }

}


