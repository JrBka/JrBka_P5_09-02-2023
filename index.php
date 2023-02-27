<?php
require_once('controllers/homeController.php');
require_once('controllers/postsController.php');
require_once('controllers/loginController.php');

try {


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
    } else {
        throw new Exception('Error 404 Page introuvable');
    }

} catch (Exception $e) {
    echo $e->getMessage();
}

