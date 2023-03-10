<?php
// Create csrf token
$csrf = new Auth();
$csrf = $csrf->csrf();
?>

<?php $title = 'INSCRIPTION'; ?>
<?php $H1 = 'INSCRIPTION'; ?>

<?php ob_start(); ?>

<section id="section-signUp" class=" mb-5 d-flex flex-column align-items-center">

    <!-- Signup form -->
    <form action="index.php?action=signup" method="post" style="min-width: 300px" class="w-25 ">
        <input type="hidden" name="csrf" value="<?= $csrf; ?>" required>
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" id="name" class="form-control" name="name" required>
        </div>
        <div class="mb-3">
            <label for="surname" class="form-label">Prénom</label>
            <input type="text" id="surname" class="form-control" name="surname" required>
        </div>
        <div class="mb-3">
            <label for="pseudo" class="form-label">Pseudo</label>
            <input type="text" id="pseudo" class="form-control" name="pseudo" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input type="email" id="email" class="form-control" name="email" required>
        </div>
        <div class="mb-3">
            <label for="pwd" class="form-label">Mot de passe</label>
            <input type="password" id="pwd" class="form-control" name="pwd" required>
        </div>
        <button type="submit" class="btn btn-warning">S'inscrire</button>
        <p>* Seul le pseudo sera visible par les utilisateurs</p>
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

