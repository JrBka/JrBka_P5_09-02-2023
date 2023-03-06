<?php

require_once('models/comment.php');

class Comments
{

    public function addComment(): void
    {


        try {

            if (empty(trim($_POST['commentContent']))) {
                throw new Exception();
            } elseif (empty($_SESSION['csrf']) || empty($_POST['csrf']) || $_SESSION['csrf'] != $_POST['csrf']) {

                throw new Exception('Le token csrf n\'a pas pu être authentifié ');

            } elseif ($_SESSION['csrf_time'] < time() - 300) {

                throw new Exception('Le token csrf à expiré !');

            } else {
                $commentContent = $_POST['commentContent'];

                $comment = new Comment();
                $comment->createComment($commentContent);
                $_SESSION['Success'] = 'Commentaire ajouté avec succès !';
                header('Location:index.php?page=postpage#section-error-success');
            }


        } catch (Exception $e) {
            $_SESSION['Error'] = $e->getMessage();
            header('Location:index.php?page=postpage#section-error-success');
        }

    }


    // Display controller of all comments
    public function getComments(): void
    {
        try {

            $_SESSION['comments'] = [];


            $getAllPosts = new Comment();
            $getAllPosts->getAllComments();


        } catch (Exception $e) {
            $_SESSION['Error'] = $e->getMessage();
            header('Location:index.php?page=postpage#section-error-success');
        }
    }



}

