<?php

require_once('models/post.php');


class Posts
{

    public function addPost(): void
    {
        try {

            if (empty(trim($_POST['content'])) || empty(trim($_POST['title']))) {

                throw new Exception('Tous les champs sont obligatoires !');

            } elseif (empty($_SESSION['csrf']) || empty($_POST['csrf']) || $_SESSION['csrf'] != $_POST['csrf']) {

                        throw new Exception('Le token csrf n\'a pas pu être authentifié ');

                    } else {

                        $_SESSION['post'] = (object)[
                            'title' => trim($_POST['title']),
                            'content' => trim($_POST['content']),
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


    public function getPostsPage(): void
    {
        try {

            $_SESSION['posts'] = [];

            $getAllPosts = new Post();
            $getAllPosts->getAllPosts();

            require('views/postsPage.php');

        } catch (Exception $e) {
            $_SESSION['Error'] = $e->getMessage();
            header('Location:index.php?page=postspage');
        }
    }


}

