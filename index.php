<?php
require_once('controllers/homePage.php');
require_once('controllers/postsPage.php');
require_once('controllers/loginPage.php');

try {

    if (empty($_GET) || (isset($_GET['page']) && $_GET['page'] == "homepage")) {
        $home = new HomePage();
        $home->getHomePage();
    } elseif (isset($_GET['page']) && $_GET['page'] == "signin") {
        $getSignIn = new Login();
        $getSignIn->getSignIn();
    } elseif (isset($_GET['page']) && $_GET['page'] == "signup") {
        $getSignUp = new Login();
        $getSignUp->getSignUp();
    } elseif ((isset($_GET['page']) && $_GET['page'] == "postspage")) {
        $posts = new PostsPage();
        $posts->getPostsPage();
    } elseif ((isset($_GET['action']) && $_GET['action'] == "form")) {
        $form = new HomePage();
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
    $errorMessage = $e->getMessage();
    echo $errorMessage;
}

