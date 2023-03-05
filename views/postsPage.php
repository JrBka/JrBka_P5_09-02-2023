<<<<<<< HEAD
<?php
$csrf = new Auth();
$csrf = $csrf->csrf();
?>
=======
>>>>>>> 3984657f22f101b62e546ba4d5f30f39f6cc37aa
<?php $title = 'Posts'; ?>
<?php $H1 = 'MES DERNIERS POSTS'; ?>

<?php ob_start(); ?>

<<<<<<< HEAD
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

        <div class=" mb-5 d-flex flex-column align-items-center ">
            <form action="index.php?action=addPost" method="post" class="w-75 ">
                <input type="hidden" name="csrf" value="<?= $csrf; ?>" required>
                <div class="mb-3">
                    <label for="title" class="form-label">Titre</label>
                    <input type="text" class="form-control" id="title" name="title" required>
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

<section id="section-posts" class="my-5 pt-5 d-flex flex-column align-items-center">
    <?php
    foreach ($_SESSION['posts'] as $value) {
        ?>
        <div class="d-flex flex-column align-items-center border border-2 my-3 w-75 text-break">
            <p class="text-center px-1 border-bottom border-2 bg-warning mt-0 w-100">Publié le
                <strong><?php $creationDate = explode(" ", $value->creationDate);
                    echo date('d-m-Y', strtotime(htmlspecialchars($creationDate[0]))); ?></strong> à
                <strong><?= htmlspecialchars($creationDate[1]); ?></strong>
                <?php if ($value->lastModification != null) {
                    $lastModification = explode(" ", $value->lastModification);
                    echo 'et modifié le <strong>' . date('d-m-Y', strtotime(htmlspecialchars($lastModification[0]))) . '</strong> à <strong>' . htmlspecialchars($lastModification[1]) . '</strong>';
                } ?>
                par <strong><?= htmlspecialchars($value->pseudo); ?></strong></p>
            <h4 class="text-center px-2"><?= htmlspecialchars($value->title); ?></h4>
            <p class="text-center px-2"><?php if (strlen($value->content) >= 500) {
                    echo substr(htmlspecialchars($value->content), 0, 500) . '...';
                } else {
                    echo htmlspecialchars($value->content);
                } ?></p>
            <form action="index.php?page=postpage" method="post" class="mb-3">
                <input type="hidden" id="postId" name="postId" value="<?= $value->postId ?>" required>
                <button class="btn btn-outline-primary text-uppercase "  type="submit">voir le post
                </button>
            </form>

        </div>
        <?php
    }
    ?>
</section>


=======
<section>
    <?= 'ok'; ?>
</section>

>>>>>>> 3984657f22f101b62e546ba4d5f30f39f6cc37aa
<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>


