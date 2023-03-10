<?php
// Create csrf token
$csrf = new Auth();
$csrf = $csrf->csrf();
?>

<?php $title = 'CONNEXION'; ?>
<?php $H1 = 'CONNEXION'; ?>


<?php ob_start(); ?>

<section id="section-signIn" class=" mb-5 d-flex flex-column align-items-center ">

     <!--SignIn form-->
    <form action="index.php?action=signin" method="post" style="min-width: 300px" class="w-25 ">
        <input type="hidden" name="csrf" value="<?= $csrf; ?>">
        <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input type="email" id="email" class="form-control" name="email" required>
        </div>
        <div class="mb-3">
            <label for="pwd" class="form-label">Mot de passe</label>
            <input type="password" id="pwd" class="form-control" name="pwd" required>
        </div>
        <button type="submit" class="btn btn-warning  ">Se connecter</button>

        <div class="mt-3 text-center">Vous n'avez pas de compte ?<br> Créez en un <a class="link text-primary"
                                                                                     href="index.php?page=signup">ici </a>!
        </div>

    </form>

</section>

<!-- Display errors and success message-->
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

<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>

