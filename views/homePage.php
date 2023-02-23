<?php $title = 'Accueil'; ?>
<?php $H1 = 'MON BLOG PRO' ?>

<?php ob_start(); ?>

<?php

if (isset($_SESSION['user']) && isset($_SESSION['firstConnexion'])) {
    ?>
    <div class="alert alert-success bg-light ">
        <h2 class="text-center "><?= $_SESSION['firstConnexion'] ?>
            <?php if (isset($_SESSION['userCreated'])) {
                echo '</br>' . $_SESSION['userCreated'];
            }
            unset($_SESSION['userCreated']) ?></h2>
    </div>
    <?php
    unset($_SESSION['firstConnexion']);
} elseif (isset($_SESSION['destroy'])) {
    ?>
    <div class="alert alert-success bg-light text-center">
        <h2 class="text-center"><?= $_SESSION['destroy'] ?></h2>
    </div>
    <?php
    unset($_SESSION['destroy']);
}
?>

    <section id="section-presentation" class="d-flex flex-column align-items-center">
        <h2 class=" text-center">Le développeur dont vous avez besoin</h2>
        <p>BOUKRA Jérémy</p>
        <div id="img-container"><img src="views/img/photoProfil.jpg" alt="photo-de-profil"></div>
        <a class="link" href="views/CV.pdf" target="_blank">Cliquez ici pour voir mon CV</a>
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
                                <input class="form-control" id="name" type="text" name="name" required/>
                                <label for="name">NOM</label>
                            </div>
                            <div class="form-floating">
                                <input class="form-control" id="email" type="email" name="email" required/>
                                <label for="email">Email</label>
                            </div>
                            <div class="form-floating">
                            <textarea class="form-control" id="message"
                                      style="height: 12rem" required name="message">
                            </textarea>
                                <label for="message">Message</label>
                            </div>
                            <br/>
                            <!-- Submit Button-->
                            <button class="btn btn-warning text-uppercase " id="submitButton" type="submit"
                                    name="submit">Envoyer
                            </button>
                            <div>
                                <?php
                                if (isset($_SESSION['homeFormError'])) {
                                    ?>
                                    <p class='alert alert-danger'><?= $_SESSION['homeFormError'] ?></p>
                                    <?php
                                    unset($_SESSION['homeFormError']);
                                } elseif (isset($_SESSION['mailSucces'])) {
                                    ?>
                                    <p class='alert alert-success'><?= $_SESSION['mailSucces'] ?></p>
                                    <?php
                                    unset($_SESSION['mailSucces']);
                                }
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $content = ob_get_clean() ?>

<?php require('layout.php') ?>