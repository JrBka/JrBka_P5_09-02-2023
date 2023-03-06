<?php
require_once('controllers/homeController.php');
require_once('controllers/postsController.php');
require_once('controllers/loginController.php');
require_once('controllers/commentsController.php');
require_once('controllers/middleWare.php');

// To use .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


try {

    // Check token and activity
    $check = new MiddleWare();
    $check->checkToken();
    $check->checkInactivity();

    if (empty($_GET) || (isset($_GET['page']) && $_GET['page'] == "homepage")) {
        $home = new Home();
        $home->getHomePage();
    } elseif (isset($_GET['page']) && $_GET['page'] == "signin") {
        $getSignIn = new Login();
        $getSignIn->getSignInPage();
    } elseif (isset($_GET['page']) && $_GET['page'] == "signup") {
        $getSignUp = new Login();
        $getSignUp->getSignUpPage();
    } elseif ((isset($_GET['page']) && $_GET['page'] == "postspage")) {
        $posts = new Posts();
        $posts->getPostsPage();
    }elseif ((isset($_GET['page']) && $_GET['page'] == "postpage")) {
        $post = new Posts();
        $post->getPostPage();
    } elseif ((isset($_GET['action']) && $_GET['action'] == "form")) {
        $form = new Home();
        $form->getMessage();
    } elseif ((isset($_GET['action']) && $_GET['action'] == "signup")) {
        $signUp = new login();
        $signUp->signUp();
    } elseif ((isset($_GET['action']) && $_GET['action'] == "signin")) {
        $signIn = new login();
        $signIn->signIn();
    } elseif ((isset($_GET['action']) && $_GET['action'] == "logout")) {
        $logout = new login();
        $logout->logout();
    } elseif ((isset($_GET['action']) && $_GET['action'] == "addPost")) {
        $addPost = new Posts();
        $addPost->addPost();
    }elseif ((isset($_GET['action']) && $_GET['action'] == "updatePost")) {
        $updatePosts = new Posts();
        $updatePosts->getUpdatePost();
    }elseif ((isset($_GET['action']) && $_GET['action'] == "deletePost")) {
        $deletePosts = new Posts();
        $deletePosts->getDeletePost();
    }elseif ((isset($_GET['action']) && $_GET['action'] == "addComment")) {
        $addComment = new Comments();
        $addComment->addComment();
    } else {
        throw new Exception('Error 404 Page introuvable');
    }

} catch (Exception $e) {
    echo $e->getMessage();
}

