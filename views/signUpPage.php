<?php $title = 'INSCRIPTION'; ?>
<?php $H1 = 'INSCRIPTION' ?>

<?php ob_start(); ?>

    <div id="section-signUp" class=" mb-5 d-flex justify-content-center">
        <form action="index.php?action=signup" method="post" style="min-width: 300px" class="w-25 ">
            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="mb-3">
                <label for="surname" class="form-label">Prénom</label>
                <input type="text" class="form-control" name="surname" required>
            </div>
            <div class="mb-3">
                <label for="pseudo" class="form-label">Pseudo</label>
                <input type="text" class="form-control" name="pseudo" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Adresse email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label for="pwd" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" name="pwd" required>
            </div>
            <button type="submit" class="btn btn-warning">S'inscrire</button>
            <p>* Seul le pseudo sera visible par les utilisateurs</p>
            <div>
                <?php
                if (isset($_SESSION['signUpError'])) {
                    ?>
                    <p class="alert alert-danger"><?= $_SESSION['signUpError'] ?></p>
                    <?php
                }
                ?>
            </div>
        </form>
    </div>

<?php $content = ob_get_clean() ?>

<?php require('layout.php') ?>