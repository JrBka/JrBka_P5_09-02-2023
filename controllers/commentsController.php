<?php

require_once('models/comment.php');
require_once('controllers/adminController.php');

class Comments
{

    // Add comment controller
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
                $_SESSION['Success'] = 'Commentaire en attente de validation !';
                header('Location:index.php?page=postpage#section-error-success');
            }


        } catch (Exception $e) {
            $_SESSION['Error'] = $e->getMessage();
            header('Location:index.php?page=postpage#section-error-success');
        }

    }


    // Display controller of all comments for each post
    public function getComments(): void
    {
        try {

            $_SESSION['comments'] = [];


            $getAllPosts = new Comment();
            $getAllPosts->getComments();


        } catch (Exception $e) {
            $_SESSION['Error'] = $e->getMessage();
            header('Location:index.php?page=postpage#section-error-success');
        }
    }


    // Display controller of all comments invalidated
    public function getAllComments(): void
    {
        try {

            $_SESSION['comments'] = [];


            $getAllPosts = new Comment();
            $getAllPosts->getAllComments();


        } catch (Exception $e) {

            $_SESSION['Error'] = $e->getMessage();
            header('Location:index.php?page=adminpage');
        }
    }


    // Validation controller
    public function validateComment():void{

        try{

            $commentId = $_POST['commentId'];

            $validateComment = new Comment();
            $validateComment->updateComment($commentId);

            $_SESSION['Success'] = 'Le commentaire a été validé avec succès !';

            $adminPage = new Admin();
            $adminPage->getAdminPage();


        } catch (Exception $e) {

            $_SESSION['Error'] = $e->getMessage();
            header('Location:index.php?page=adminpage');
        }

    }

    // Delete comment controller
    public function deleteComment():void{
        try {

            $commentId = $_POST['commentId'];

            $deleteComment = new Comment();
            $deleteComment->deleteComment($commentId);

            $_SESSION['Success'] = 'Le commentaire a été supprimé avec succès !';

            header('Location:index.php?page=adminpage');

        } catch (Exception $e) {
            $_SESSION['Error'] = $e->getMessage();
            header('Location:index.php?page=adminpage');
        }
    }

}

