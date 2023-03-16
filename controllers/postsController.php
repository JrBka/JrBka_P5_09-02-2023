<?php

require_once('models/post.php');
require_once('controllers/commentsController.php');


class Posts
{
    // Add post controller
    public function addPost(): void
    {
        try {

            if (empty(trim($_POST['content'])) || empty(trim($_POST['title'])) || empty(trim($_POST['chapo'])) ) {

                throw new Exception('Tous les champs sont obligatoires !');

            }elseif (strlen($_POST['title']) > 100){

                throw new Exception('Le titre doit être renseigné et ne doit pas excéder 100 caractères');

            }elseif (strlen($_POST['chapo']) > 500){

                throw new Exception('Le chapo doit être renseigné et ne doit pas excéder 500 caractères');

            }else {

                $postContent = (object)[
                    'title' => trim($_POST['title']),
                    'content' => trim($_POST['content']),
                    'chapo' => trim($_POST['chapo']),
                    'userId' => $_SESSION['user']->id
                ];

                $post = new Post();
                $post->createPost($postContent);

                $_SESSION['post'] = $postContent;

                $_SESSION['Success'] = 'Post en attente de validation !';
                header('Location:index.php?page=postspage#section-addPost');
            }

        } catch (Exception $e) {
            $_SESSION['Error'] = $e->getMessage();
            header('Location:index.php?page=postspage#section-addPost');
        }
    }


    // Display controller of all validated posts
    public function getPostsPage(): void
    {
        try {

            $getAllPosts = new Post();
            $getAllPosts = $getAllPosts->getValidatedPosts();

            $_SESSION['posts'] = $getAllPosts;
            require('views/postsPage.php');

        } catch (Exception $e) {
            $_SESSION['Error'] = $e->getMessage();
            header('Location:index.php?page=postspage#section-error-success');
        }
    }


    // Display controller of all invalidated posts
    public function getInvalidatedPosts(): void
    {
        try {

            $getAllPosts = new Post();
            $getAllPosts = $getAllPosts->getInvalidatedPosts();

            $_SESSION['posts'] = $getAllPosts;

        } catch (Exception $e) {
            $_SESSION['Error'] = $e->getMessage();
            header('Location:index.php?page=adminpage#section-error-success');
        }
    }


    // Display controller of post page
    public function getPostPage(): void
    {
        try {

            if (isset($_POST['postId'])){

                $postId = (int)$_POST['postId'];

                $getPost = new Post();
                $getPost = $getPost->getPost($postId);

                $_SESSION['post'] = $getPost;

                $getComments = new Comments();
                $getComments->getValidatedComments();

                $_SESSION['formUpdate'] = false;

                require('views/postPage.php');
            }

        } catch (Exception $e) {
            $_SESSION['Error'] = $e->getMessage();
            header('Location:index.php?page=postpage#section-error-success');
        }
    }


    // Display update form
    public function getUpdatePostForm(): void
    {
        try {

                $_SESSION['formUpdate'] = true;
                require('views/postPage.php');


        } catch (Exception $e) {
            $_SESSION['Error'] = $e->getMessage();
            header('Location:index.php?page=postpage#section-error-success');
        }
    }

    // Update post controller
    public function userUpdatePost():void{
        try {

            // Form control
            if (empty(trim($_POST['content'])) || empty(trim($_POST['title'])) || empty(trim($_POST['chapo'])) || empty(trim($_POST['author']))) {

                throw new Exception('Tous les champs sont obligatoires !');

            }else {

                    $formUpdateContent = (object)[
                        'title' => trim($_POST['title']),
                        'content' => trim($_POST['content']),
                        'chapo' => trim($_POST['chapo']),
                        'author' => trim($_POST['author']),
                        'postId' => $_SESSION['post']->postId,
                        'lastModification' => date("Y-m-d H:i:s"),
                        'is_validate' => 0
                    ];

                    $getPost = new Post();
                    $getPost->updatePost($formUpdateContent);

                    $_SESSION['Success'] = 'Modification en attente de validation !';
                    header('Location:index.php?page=postspage#section-addPost');
            }

        } catch (Exception $e) {
            $_SESSION['Error'] = $e->getMessage();
            header('Location:index.php?page=postpage#section-error-success');
        }
    }


    // Validation controller
    public function adminUpdatePost():void{

        try{

            $postId = $_POST['postId'];

            $validateComment = new Post();
            $validateComment->validatePost($postId);

            $_SESSION['Success'] = 'Le post a été validé avec succès !';

            $adminPage = new Admin();
            $adminPage->getAdminPage();


        } catch (Exception $e) {

            $_SESSION['Error'] = $e->getMessage();
            header('Location:index.php?page=adminpage#section-error-success');
        }

    }


    // User delete post controller
    public function userDeletePost():void{
        try {

            $postId = $_SESSION['post']->postId;

            $deletePost = new Post();
            $deletePost->deletePost($postId);

            $_SESSION['Success'] = 'Votre post a été supprimé avec succès !';

            header('Location:index.php?page=postspage#section-addPost');

        } catch (Exception $e) {
            $_SESSION['Error'] = $e->getMessage();
            header('Location:index.php?page=postpage#section-error-success');
        }
    }

    // Admin delete post controller
    public function adminDeletePost():void{
        try {

            $postId = $_POST['postId'];

            $deletePost = new Post();
            $deletePost->deletePost($postId);

            $_SESSION['Success'] = 'Le post a été supprimé avec succès !';

            header('Location:index.php?page=adminpage#section-error-success');

        } catch (Exception $e) {
            $_SESSION['Error'] = $e->getMessage();
            header('Location:index.php?page=adminpage#section-error-success');
        }
    }

}

