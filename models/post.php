<?php

require_once('models/database.php');

class Post extends Database
{

    // Insert post in posts table
    public function createPost(): void
    {

        $this->getConnection();


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

    // Get all posts in database
    public function getAllPosts() :void
    {


            $this->getConnection();

            $query = "SELECT userId,postId,title,content,chapo,creationDate,lastModification,pseudo,author FROM posts INNER JOIN users WHERE posts.userId= users.id ORDER BY creationDate DESC ";
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

    }

    // Get one post in database
    public function getPost():void{


            $this->getConnection();

            $query = "SELECT userId,postId,title,chapo,content,creationDate,lastModification,pseudo,author FROM posts INNER JOIN users WHERE posts.userId= users.id AND postId = :postId";
            $getPost = $this->connection->prepare($query);
            $getPost->execute(  ['postId'=>$_SESSION['post']->postId]) or throw new Exception();
            $fetch = $getPost->fetchObject();

            if (is_bool($fetch) && !$fetch) {

                throw new Exception();

            } else {

                    $_SESSION['post'] = (object)$fetch;

            }

    }

    // Update post
    public function updatePost( object $formUpdateContent):void{

        $this->getConnection();



            $query = "UPDATE posts SET content = :content, title = :title, chapo = :chapo, author = :author, lastModification = :lastModification WHERE postId = :postId";

            $updatePost = $this->connection->prepare($query);
            $updatePost->execute(
                [
                    'postId' => $formUpdateContent->postId,
                    'title' => $formUpdateContent->title,
                    'content' => $formUpdateContent->content,
                    'chapo' => $formUpdateContent->chapo,
                    'author' => $formUpdateContent->author,
                    'lastModification' => $formUpdateContent->lastModification

                ]
            ) or throw new Exception();


    }

    // Delete post
    public function deletePost():void{

        $this->getConnection();



            $query = "DELETE FROM posts WHERE postId = :postId";

            $insertPost = $this->connection->prepare($query);
            $insertPost->execute(
                [
                    'postId' => $_SESSION['post']->postId
                ]
            ) or throw new Exception();



    }

}


