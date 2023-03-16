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
            }else {
                $commentContent =(object) [
                   'content' => $_POST['commentContent'],
                    'userId' => $_SESSION['user']->id,
                    'postId' => $_SESSION['post']->postId
                ];

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
    public function getValidatedComments(): void
    {
        try {


            $validateComments = (object)[
                'postId'=> $_SESSION['post']->postId,
                'is_validate'=>1
            ];

            $getAllPosts = new Comment();
            $comments = $getAllPosts->getValidatedComments($validateComments);

            $_SESSION['comments'] = $comments;

        } catch (Exception $e) {
            $_SESSION['Error'] = $e->getMessage();
            header('Location:index.php?page=postpage#section-error-success');
        }
    }


    // Display controller of all comments invalidated
    public function getInvalidatedComments(): void
    {
        try {

            $invalidateComments = (object)[
                'is_validate'=>0
            ];

            $getAllPosts = new Comment();
            $comments = $getAllPosts->getInvalidatedComments($invalidateComments);

            $_SESSION['comments'] = $comments;

        } catch (Exception $e) {

            $_SESSION['Error'] = $e->getMessage();
            header('Location:index.php?page=adminpage#section-error-success');
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
            header('Location:index.php?page=adminpage#section-error-success');
        }

    }

    // Delete comment controller
    public function deleteComment():void{
        try {

            $commentId = $_POST['commentId'];

            $deleteComment = new Comment();
            $deleteComment->deleteComment($commentId);

            $_SESSION['Success'] = 'Le commentaire a été supprimé avec succès !';

            $adminPage = new Admin();
            $adminPage->getAdminPage();

        } catch (Exception $e) {
            $_SESSION['Error'] = $e->getMessage();
            header('Location:index.php?page=adminpage#section-error-success');
        }
    }

}

