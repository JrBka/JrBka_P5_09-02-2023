<?php
$crsf = new Auth();
$crsf = $crsf->crsf();
?>

<?php $title = 'CONNEXION'; ?>
<?php $H1 = 'CONNEXION' ?>


<?php ob_start(); ?>

<div id="section-signIn" class=" mb-5 d-flex flex-column align-items-center ">
    <form action="index.php?action=signin" method="post" style="min-width: 300px" class="w-25 ">
        <input type="hidden" name="crsf" value="<?= bin2hex($crsf) ?>">
        <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="mb-3">
            <label for="pwd" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" name="pwd" required>
        </div>
        <button type="submit" class="btn btn-warning  ">Se connecter</button>
        <div class="text-center">
            <p>Vous n'avez pas de compte ?</br> créez en un <a class="link-primary" href="index.php?page=signup">ICI</a>
            </p>
        </div>
    </form>
    <div>
        <?php
        if (isset($_SESSION['Error'])) {
            ?>
            <p class='alert alert-danger'><?= $_SESSION['Error'] ?></p>
            <?php
            unset($_SESSION['Error']);
        }
        ?>
    </div>
</div>

<?php $content = ob_get_clean() ?>

<?php require('layout.php') ?>
