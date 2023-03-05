<?php $title = 'Accueil'; ?>
<?php $H1 = 'MON BLOG PRO'; ?>

<?php ob_start(); ?>

<?php

if (isset($_SESSION['user']) && isset($_SESSION['atConnection']) && $_SESSION['atConnection'] === true) {
    ?>
    <div class="alert alert-success bg-light ">
        <h2 class="text-center "><?= 'Bonjour ' . htmlspecialchars($_SESSION['user']->pseudo) . ' !' ?>
            <?php if (isset($_SESSION['userCreated']) && $_SESSION['userCreated'] === true) {
                echo '</br>' . 'Votre profil a bien été créé !';
            }
            $_SESSION['userCreated'] = false; ?></h2>
    </div>
    <?php
    $_SESSION['atConnection'] = false;
} elseif (isset($_SESSION['destroy']) && $_SESSION['destroy'] === true) {
    ?>
    <div class="alert alert-success bg-light text-center">
        <h2 class="text-center">Vous êtes déconnecté</h2>
    </div>
    <?php
    $_SESSION['destroy'] = false;
<<<<<<< HEAD
} elseif (isset($_SESSION['tokenError']) && $_SESSION['tokenError'] === true) {
    ?>
    <div class="alert alert-danger bg-light text-center">
        <h2 class="text-center">Vous avez été déconnecté!<br> Veuillez vous authentifier à nouveau.</h2>
    </div>
    <?php
    $_SESSION['tokenError'] = false;
=======
} elseif (isset($_SESSION['TokenError']) && $_SESSION['TokenError'] === true) {
    ?>
    <div class="alert alert-danger bg-light text-center">
        <h2 class="text-center">Veuillez vous authentifier !</h2>
    </div>
    <?php
    $_SESSION['TokenError'] = false;
>>>>>>> 3984657f22f101b62e546ba4d5f30f39f6cc37aa
}
?>

<section id="section-presentation" class="d-flex flex-column align-items-center">
    <h2 class=" text-center">Le développeur dont vous avez besoin</h2>
    <p>BOUKRA Jérémy</p>
    <div id="img-container"><img src="views/img/photoProfil.jpg" alt="photo-de-profil"></div>
<<<<<<< HEAD
    <span class="mt-3 text-center">Cliquez<a class="link text-primary" href="views/CV.pdf" target="_blank"> ici </a>pour voir mon CV</span>
=======
    <a class="link" href="views/CV.pdf" target="_blank">Cliquez ici pour voir mon CV</a>
>>>>>>> 3984657f22f101b62e546ba4d5f30f39f6cc37aa
</section>
<section id="section-contact" class="mt-5 mb-3">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <h2 class="text-center">Un projet en tête ? Contactez moi !</br> Je répondrais dans les plus brefs
                    délais !</h2>
                <div class="my-5">
                    <form id="contactForm" action="index.php?action=form"
                          method="post">
                        <div class="form-floating">
                            <input class="form-control" id="name" type="text" name="name"
<<<<<<< HEAD
                                   value="<?php if (!empty($_SESSION['user'])) {
=======
                                   value="<?php if ($_SESSION['LOGGED_USER'] === true) {
>>>>>>> 3984657f22f101b62e546ba4d5f30f39f6cc37aa
                                       echo htmlspecialchars($_SESSION['user']->pseudo);
                                   } ?>"
                                   required/>
                            <label for="name">NOM</label>
                        </div>
                        <div class="form-floating">
                            <input class="form-control" id="email" type="email" name="email"
<<<<<<< HEAD
                                   value="<?php if (!empty($_SESSION['user'])) {
=======
                                   value="<?php if ($_SESSION['LOGGED_USER'] === true) {
>>>>>>> 3984657f22f101b62e546ba4d5f30f39f6cc37aa
                                       echo htmlspecialchars($_SESSION['user']->email);
                                   } ?>" required/>
                            <label for="email">Email</label>
                        </div>
                        <div class="form-floating">
                                <textarea class="form-control" id="message" style="height: 12rem" name="message"
                                          required></textarea>
                            <label for="message">Message</label>
                        </div>
                        <br/>
                        <!-- Submit Button-->
                        <button class="btn btn-warning text-uppercase " id="submitButton" type="submit"
                                name="submit">Envoyer
                        </button>
                        <div>
                            <?php
                            if (isset($_SESSION['Error'])) {
                                ?>
                                <p class='alert alert-danger'><?= $_SESSION['Error']; ?></p>
                                <?php
                                unset($_SESSION['Error']);
<<<<<<< HEAD
                            } elseif (isset($_SESSION['Success'])) {
                                ?>
                                <p class='alert alert-success'><?= $_SESSION['Success']; ?></p>
                                <?php
                                unset($_SESSION['Success']);
=======
                            } elseif (isset($_SESSION['Succes'])) {
                                ?>
                                <p class='alert alert-success'><?= $_SESSION['Succes']; ?></p>
                                <?php
                                unset($_SESSION['Succes']);
>>>>>>> 3984657f22f101b62e546ba4d5f30f39f6cc37aa
                            }
                            ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>

