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

            }elseif (empty($_SESSION['csrf']) || empty($_POST['csrf']) || $_SESSION['csrf'] != $_POST['csrf']) {

                throw new Exception('Le token csrf n\'a pas pu être authentifié ');

            }elseif ($_SESSION['csrf_time'] < time() - 300){

                throw new Exception('Le token csrf à expiré !');

            } else {

                $_SESSION['post'] = (object)[
                    'title' => trim($_POST['title']),
                    'content' => trim($_POST['content']),
                    'chapo' => trim($_POST['chapo']),
                    'userId' => $_SESSION['user']->id
                ];

                $post = new Post();
                $post->createPost();
                $_SESSION['Success'] = 'Post ajouté avec succès !';
                header('Location:index.php?page=postspage#section-addPost');
            }

        } catch (Exception $e) {
            $_SESSION['Error'] = $e->getMessage();
            header('Location:index.php?page=postspage#section-addPost');
        }
    }


    // Display controller of all posts
    public function getPostsPage(): void
    {
        try {

            $_SESSION['posts'] = [];

            $getAllPosts = new Post();
            $getAllPosts->getValidatedPosts();

            require('views/postsPage.php');

        } catch (Exception $e) {
            $_SESSION['Error'] = $e->getMessage();
            header('Location:index.php?page=postspage');
        }
    }


    // Display controller of all posts
    public function getInvalidatedPosts(): void
    {
        try {

            $_SESSION['posts'] = [];

            $getAllPosts = new Post();
            $getAllPosts->getinValidatedPosts();


        } catch (Exception $e) {
            $_SESSION['Error'] = $e->getMessage();
            header('Location:index.php?page=adminpage');
        }
    }


    // Display controller of post page
    public function getPostPage(): void
    {
        try {

            if (isset($_POST['postId'])){
                $_SESSION['post']=(object)['postId'=>$_POST['postId']];
            }


            $getPost = new Post();
            $getPost->getPost();


            $getComments = new Comments();
            $getComments->getComments();

            $_SESSION['formUpdate'] = false;

            require('views/postPage.php');

        } catch (Exception $e) {
            $_SESSION['Error'] = $e->getMessage();
            header('Location:index.php?page=postpage');
        }
    }

    // Update post controller
    public function userUpdatePost():void{
        try {

            // Display update form
            if (empty($_POST)){

                $_SESSION['formUpdate'] = true;

                require('views/postPage.php');

            }
            // Form control
            elseif (empty(trim($_POST['content'])) || empty(trim($_POST['title'])) || empty(trim($_POST['chapo'])) || empty(trim($_POST['author']))) {

                throw new Exception('Tous les champs sont obligatoires !');

            } elseif (empty($_SESSION['csrf']) || empty($_POST['csrf']) || $_SESSION['csrf'] != $_POST['csrf']) {

                throw new Exception('Le token csrf n\'a pas pu être authentifié ');

            }elseif ($_SESSION['csrf_time'] < time() - 300){

                throw new Exception('Le token csrf à expiré !');

            } else {

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

                    $_SESSION['Success'] = 'Post modifié avec succès !';
                    header('Location:index.php?page=postspage#section-addPost');
            }

        } catch (Exception $e) {
            $_SESSION['Error'] = $e->getMessage();
            header('Location:index.php?page=postpage');
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
            header('Location:index.php?page=adminpage');
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
            header('Location:index.php?page=postpage');
        }
    }

    // Admin delete post controller
    public function adminDeletePost():void{
        try {

            $postId = $_POST['postId'];

            $deletePost = new Post();
            $deletePost->deletePost($postId);

            $_SESSION['Success'] = 'Le post a été supprimé avec succès !';

            header('Location:index.php?page=adminpage');

        } catch (Exception $e) {
            $_SESSION['Error'] = $e->getMessage();
            header('Location:index.php?page=adminpage');
        }
    }

}

