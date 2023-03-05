<?php
// Create csrf token
$csrf = new Auth();
$csrf = $csrf->csrf();
?>
<?php $title = 'Posts'; ?>
<?php $H1 = 'MES DERNIERS POSTS'; ?>

<?php ob_start(); ?>

<!-- Displays a login request message to make a post -->
<section id="section-addPost">
    <h2 class="text-center mb-4">AJOUTER UN POST</h2>
    <?php if (!isset($_SESSION['user'])) {
        ?>
        <div class="alert alert-success bg-light text-center w-75 m-auto">
            <h3 class="text-center ">Veuillez vous connecter pour ajouter un post ! </h3>
            <i class="fa-sharp fa-solid fa-arrow-down fa-2x "></i><br>
            <div class="my-0">Connectez vous<a class="link text-primary"
                                               href="index.php?page=signin#section-signIn"> ici </a>!
            </div>
        </div>
        <?php
    } else {
        ?>

        <!-- Add post form -->
        <div class=" mb-5 d-flex flex-column align-items-center ">
            <form action="index.php?action=addPost" method="post" class="w-75 ">
                <input type="hidden" name="csrf" value="<?= $csrf; ?>" required>
                <div class="mb-3">
                    <label for="title" class="form-label">Titre</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="chapo" class="form-label">Chapô</label>
                    <textarea class="form-control" id="chapo" name="chapo" style="height: 6rem" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Contenu</label>
                    <textarea class="form-control" id="content" name="content" style="height: 12rem" required></textarea>
                </div>
                <button type="submit" class="btn btn-warning">ENVOYER</button>
            </form>
        </div>
        <?php
    } ?>
</section>

<!-- Display errors -->
<section id="section-error" class="w-75 m-auto">

    <div class="text-center">
        <?php

            if (isset($_SESSION['Error'])) {
        ?>
        <p class='alert alert-danger'><?= $_SESSION['Error']; ?></p>
        <?php
            unset($_SESSION['Error']);

        }else if (isset($_SESSION['Success'])) {
            ?>
            <p class='alert alert-success'><?= $_SESSION['Success']; ?></p>
            <?php
            unset($_SESSION['Success']);
        }
        ?>
    </div>

</section>

<!-- Display all posts -->
<section id="section-posts" class="my-5 pt-5 d-flex flex-column align-items-center">
    <?php
    if (!empty($_SESSION['posts'])){

    foreach ($_SESSION['posts'] as $value) {
        ?>
        <div class="d-flex flex-column align-items-center border border-2 my-3 w-75 text-break">
            <p class="text-center px-1 border-bottom border-2 bg-warning mt-0 w-100">Publié le
                <strong><?php $creationDate = explode(" ", $value->creationDate);
                    echo date('d-m-Y', strtotime(htmlspecialchars($creationDate[0]))); ?></strong> à
                <strong><?= htmlspecialchars($creationDate[1]); ?></strong>
                <?php if ($value->lastModification !== null) {
                    $lastModification = explode(" ", $value->lastModification);
                    echo 'et modifié le <strong>' . date('d-m-Y', strtotime(htmlspecialchars($lastModification[0]))) . '</strong> à <strong>' . htmlspecialchars($lastModification[1]) . '</strong>';
                } ?>
                par <strong><?php if ( isset($value->author) && $value->author !== null ){echo htmlspecialchars($value->author);}else{ echo htmlspecialchars($value->pseudo);} ?></strong></p>
            <h4 class="text-center px-2"><?= htmlspecialchars($value->title); ?></h4>
            <p class="text-center px-2"><?= htmlspecialchars($value->chapo);
                 ?></p>

            <!-- Link for post -->
            <form action="index.php?page=postpage" method="post" class="mb-3">
                <input type="hidden" id="postId" name="postId" value="<?= $value->postId ?>" required>
                <button class="btn btn-outline-primary text-uppercase "  type="submit">voir le post
                </button>
            </form>

        </div>
        <?php
        }
    }else{
        echo '<h3>Pas de post pour le moment !</h3>';
    }
    ?>
</section>


<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>


