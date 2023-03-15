<?php
// Create csrf token
$csrf = new Auth();
$csrf = $csrf->csrf();
?>

<?php $title = 'Admin'; ?>
<?php $H1 = 'ADMIN'; ?>

<?php if ($_SESSION['Display'] === false){
    ?>
    <h1 style="text-align: center; margin-top: 50vh;font-size: xxx-large">Vous ne disposez pas des droits nécessaire pour consulter cette page !</h1>
<?php }else{?>

<?php ob_start(); ?>


<!-- Display error and success messages -->
<section id="section-error-success" class="w-75 m-auto">

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

<!-- Display posts awaiting validations -->
<section class="my-5 pt-5 d-flex flex-column align-items-center w-75 mx-auto">
    <h3 class="text-center ">Posts à valider </h3>
    <?php
    if (!empty($_SESSION['posts']) ){

        foreach ($_SESSION['posts'] as $value) {

            ?>

            <div class="d-flex flex-column align-items-center border border-1 border-primary my-3 w-75 text-break">
                <p class="text-center bg-light px-1 border-bottom border-1 border-primary mt-0 w-100 text-dark">Publié le
                    <strong ><?php $creationDate = explode(" ", $value->creationDate);
                        echo date('d-m-Y', strtotime(htmlspecialchars($creationDate[0]))); ?></strong> à
                    <strong><?= htmlspecialchars($creationDate[1]); ?></strong>
                    <?php if ($value->lastModification !== null) {
                        $lastModification = explode(" ", $value->lastModification);
                        echo 'et modifié le <strong>' . date('d-m-Y', strtotime(htmlspecialchars($lastModification[0]))) . '</strong> à <strong>' . htmlspecialchars($lastModification[1]) . '</strong>';
                    } ?>
                    par <strong><?= htmlspecialchars($value->pseudo); ?></strong></p>
                <h4 class="text-center px-2  mb-4"><?= htmlspecialchars($value->title); ?></h4>
                <h5 class="text-center px-2 fst-italic mb-4" ><?= htmlspecialchars($value->chapo);?></h5>
                <p class="text-center mt-0 px-2 "><?= htmlspecialchars($value->content); ?></p>
                <div class="d-flex flex-column align-items-center flex-md-row">
                    <form action="index.php?action=validatePost" method="post" >
                        <input type="hidden" name="csrf" value="<?= $csrf; ?>" required>
                        <input type="hidden" value="<?= $value->postId ?>"  name="postId" >
                        <button class="btn btn-sm btn-outline-success text-uppercase m-3"  type="submit">Valider
                        </button>
                    </form>

                    <form action="index.php?action=adminDeletePost" method="post" >
                        <input type="hidden" name="csrf" value="<?= $csrf; ?>" required>
                        <input type="hidden" value="<?= $value->postId ?>"  name="postId" >
                        <button class="btn btn-sm btn-outline-danger text-uppercase m-3"  type="submit">Supprimer</button>
                    </form>
                </div>

            </div>
            <?php

        }
    }else{
        echo '<h5 class="text-center">Aucun post à valider pour le moment !</h5>';
    }
    ?>
</section>

<!-- Display comments awaiting validations -->
 <section class="my-5 pt-5 d-flex flex-column align-items-center w-75 mx-auto">
        <h3 class="text-center ">Commentaires à valider </h3>
        <?php
        if (!empty($_SESSION['comments']) ){

        foreach ($_SESSION['comments'] as $value) {

            ?>

            <div class="d-flex flex-column align-items-center border border-1 border-primary my-3 w-75 text-break">
                <p class="text-center bg-light px-1 border-bottom border-1 border-primary mt-0 w-100 text-dark">Publié le
                    <strong ><?php $creationDate = explode(" ", $value->creationDate);
                        echo date('d-m-Y', strtotime(htmlspecialchars($creationDate[0]))); ?></strong> à
                    <strong><?= htmlspecialchars($creationDate[1]); ?></strong>
                    par <strong><?= htmlspecialchars($value->pseudo); ?></strong></p>
                <p class="text-center mt-0 px-2 "><?= htmlspecialchars($value->content);
                    ?></p>
                <div class="d-flex flex-column align-items-center flex-md-row">
                    <form action="index.php?action=validateComment" method="post" >
                        <input type="hidden" name="csrf" value="<?= $csrf; ?>" required>
                        <input type="hidden" value="<?= $value->commentId ?>"  name="commentId" >
                        <button class="btn btn-sm btn-outline-success text-uppercase m-3"  type="submit">Valider</button>
                    </form>

                    <form action="index.php?action=deleteComment" method="post" >
                        <input type="hidden" name="csrf" value="<?= $csrf; ?>" required>
                        <input type="hidden" value="<?= $value->commentId ?>"  name="commentId" >
                        <button class="btn btn-sm btn-outline-danger text-uppercase m-3"  type="submit">Supprimer</button>
                    </form>
                </div>

            </div>
                <?php

            }
        }else{
                echo '<h5 class="text-center">Aucun commentaire à valider pour le moment !</h5>';
            }
        ?>
    </section>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>

<?php } ?>




