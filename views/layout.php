<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title><?= $title ?></title>
    <link rel="icon" href="views/img/bg-home.webp"/>
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet"
          type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800"
          rel="stylesheet" type="text/css"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="styles.css" rel="stylesheet"/>

</head>

<body>

<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="index.php?page=homepage">
            <div class="logo"></div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="index.php?page=homepage">ACCUEIL</a>
                </li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4"
                                        href="index.php?page=homepage#section-presentation">À PROPOS</a></li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="index.php?page=postspage">POSTS</a>
                </li>
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4"
                                        href="index.php?page=homepage#section-contact">CONTACT</a></li>
                <?php
                if ($_SESSION['LOGGED_USER'] === true) {
                    ?>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4"
                                            href="index.php?action=logout">DECONNEXION</a></li>
                    <?php

                } else {
                    ?>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4"
                                            href="index.php?page=signin">CONNEXION</a></li>
                    <?php
                }
                ?>
            </ul>
            <a href="https://github.com/JrBka?tab=repositories" target="_blank">
                <span class="fa-stack fa-lg">
                    <i class="fas fa-circle fa-stack-2x"></i>
                    <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                </span>
            </a>
        </div>
    </div>
</nav>
<!-- Page Header-->
<header class="masthead" style="background-image: url('views/img/bg-home.webp')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1><?= $H1 ?></h1>
                    <span class="subheading">Développement PHP</span>
                </div>
            </div>
        </div>
    </div>
</header>

<?= $content ?>

<!-- Footer-->
<footer class="border-top" style="background-image: url('views/img/bg-home.webp') ; background-size:contain">
    <div id="footer-container" class=" container px-4 px-lg-5">

        <div class="d-flex flex-column justify-content-around flex-md-row">
            <ul class="d-flex align-items-center flex-column">
                <li class="footer-li"><a href="index.php?page=homepage" class="logo-container">
                        <div class="logo"></div>
                    </a></li>
                <?php
                if ($_SESSION['LOGGED_USER'] === true) {
                    ?>
                    <li class="footer-li">
                        <a class="link" href="index.php?action=logout">Déconnexion</a>
                    </li>
                    <?php
                } else {
                    ?>
                    <li class="footer-li">
                        <a class="link" href="index.php?page=signin">Connexion</a>
                    </li>
                    <?php
                }
                ?>

            </ul>

            <ul class=" text-center">
                <h4 class="text-warning">MENU</h4>
                <li class="footer-li"><a class="link" href="index.php?page=homepage"">Accueil</a></li>
                <li class="footer-li"><a class="link" href="index.php?page=homepage#section-presentation">À propos</a>
                </li>
                <li class="footer-li"><a class="link" href="index.php?page=postspage">Posts</a></li>
                <li class="footer-li"><a class="link" href="index.php?page=homepage#section-contact">Contact</a></li>
            </ul>
            <ul class="text-center">
                <h4 class="text-warning">INFORMATIONS</h4>
                <li class="footer-li"><a class="link" href="views/CV.pdf" target="_blank">CV</a></li>
                <li class="footer-li"><a class="link" href="https://github.com/JrBka?tab=repositories" target="_blank">GitHub</a>
                </li>
            </ul>
        </div>

    </div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>

</body>
</html>