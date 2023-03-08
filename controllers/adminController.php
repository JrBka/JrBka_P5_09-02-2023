<?php
require_once('controllers/commentsController.php');
require_once('controllers/postsController.php');

class Admin
{

    // Display admin page
    public function getAdminPage():void{

        $getPosts = new Posts();
        $getPosts->getInvalidatedPosts();

        $getComments = new Comments();
        $getComments->getAllComments();

        require('views/adminPage.php');

    }



}