<?php
require_once('controllers/homeController.php');
require_once('controllers/postsController.php');
require_once('controllers/loginController.php');
require_once('controllers/commentsController.php');
require_once('controllers/adminController.php');
require_once('controllers/middleWare.php');

// To use .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


try {

    // Check token and activity
    $check = new MiddleWare();
    $check->checkSessionToken();
    $check->checkInactivity();


    if (!empty($_POST) && !empty($_GET['action'])){

        $check->checkCsrfToken();

        switch ($_GET['action']){

            case 'contactForm':
                $form = new Home();
                $form->getMessage();
                break;

            case 'signin':
                $signIn = new Login();
                $signIn->signIn();
                break;

            case 'signup':
                $signUp = new Login();
                $signUp->signUp();
                break;

            case 'addPost':
                $addPost = new Posts();
                $addPost->addPost();
                break;

            case 'getUpdatePostForm':
                $getUpdatePostForm = new Posts();
                $getUpdatePostForm->getUpdatePostForm();
                break;

            case 'updatePost':
                $updatePosts = new Posts();
                $updatePosts->userUpdatePost();
                break;

            case 'validatePost':
                $validatePost = new Posts();
                $validatePost->adminUpdatePost();
                break;

            case 'deletePost':
                $deletePosts = new Posts();
                $deletePosts->userDeletePost();
                break;

            case 'adminDeletePost':
                $deletePosts = new Posts();
                $deletePosts->adminDeletePost();
                break;

            case 'addComment':
                $addComment = new Comments();
                $addComment->addComment();
                break;

            case 'validateComment':
                $validateComment = new Comments();
                $validateComment->validateComment();
                break;

            case 'deleteComment':
                $deleteComment = new Comments();
                $deleteComment->deleteComment();
                break;

            default:
                throw new Exception('<h1 style="text-align: center; margin-top: 50vh;font-size: xxx-large">Error 404 : Page introuvable</h1>');
        }

    }elseif (!empty($_GET) && !empty($_GET['page'])){

        switch ($_GET['page']) {

            case 'homepage':
                $home = new Home();
                $home->getHomePage();
                break;

            case 'signin':
                $getSignIn = new Login();
                $getSignIn->getSignInPage();
                break;

            case 'signup':
                $getSignUp = new Login();
                $getSignUp->getSignUpPage();
                break;

            case 'logout':
                $logout = new Login();
                $logout->logout();
                break;

            case 'postspage':
                $posts = new Posts();
                $posts->getPostsPage();
                break;

            case 'postpage':
                $post = new Posts();
                $post->getPostPage();
                break;

            case 'adminpage':
                $check->checkRole();
                $admin = new Admin();
                $admin->getAdminPage();
                break;

            default:
                throw new Exception('<h1 style="text-align: center; margin-top: 50vh;font-size: xxx-large">Error 404 : Page introuvable</h1>');
        }

    }else{

        $home = new Home();
        $home->getHomePage();

    }


} catch (Exception $e) {
    echo $e->getMessage();
}

