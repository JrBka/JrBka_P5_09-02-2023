<?php
require_once('controllers/commentsController.php');

class Admin
{

    // Display admin page
    public function getAdminPage():void{

        $getComments = new Comments();
        $getComments->getAllComments();

        require('views/adminPage.php');

    }



}