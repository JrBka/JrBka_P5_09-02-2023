<?php
// Create csrf token
$csrf = new Auth();
$csrf = $csrf->csrf();
?>

<?php $title = 'Post'; ?>
<?php $H1 = 'POST'; ?>

<?php ob_start(); ?>

    <section id="section-posts" class="my-5 pt-5 d-flex flex-column align-items-center">

        <!--Update post form-->
            <?php if (isset($_SESSION['formUpdate']) && $_SESSION['formUpdate'] === true){
                ?>
                <div class=" mb-5 d-flex flex-column align-items-center w-100">
                    <form action="index.php?action=updatePost" method="post" class="w-75">
                        <input type="hidden" name="csrf" value="<?= $csrf; ?>" required>
                        <div class="mb-3">
                            <label for="author" class="form-label">Auteur</label>
                            <input type="text" class="form-control" id="author" name="author" value=<?php if (isset($_SESSION['post']->author) && $_SESSION['post']->author !== null ){echo htmlspecialchars($_SESSION['post']->author);}else{ echo htmlspecialchars($_SESSION['post']->pseudo);} ?> required>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Titre</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($_SESSION['post']->title) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="chapo" class="form-label">Chapo</label>
                            <textarea class="form-control" id="chapo" name="chapo"   style="height: 12rem" required><?= htmlspecialchars($_SESSION['post']->chapo) ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Contenu</label>
                            <textarea class="form-control" id="content" name="content"  style="height: 12rem" required><?= htmlspecialchars($_SESSION['post']->content) ?> </textarea>
                        </div>
                        <button type="submit" class="btn btn-warning">ENVOYER</button>
                    </form>
                </div>
        <?php
            } ?>


        <!--Display post-->
        <div class="d-flex flex-column align-items-center border border-2 my-3 w-75 text-break">
                    <p class="text-center px-1 border-bottom border-2 bg-warning mt-0 w-100">Publié le
                        <strong><?php $creationDate = explode(" ", $_SESSION['post']->creationDate);
                            echo date('d-m-Y', strtotime(htmlspecialchars($creationDate[0]))); ?></strong> à
        <strong><?= htmlspecialchars($creationDate[1]); ?></strong>
        <?php if ($_SESSION['post']->lastModification !== null) {
            $lastModification = explode(" ", $_SESSION['post']->lastModification);
            echo 'et modifié le <strong>' . date('d-m-Y', strtotime(htmlspecialchars($lastModification[0]))) . '</strong> à <strong>' . htmlspecialchars($lastModification[1]) . '</strong>';
        } ?>
        par <strong><?php if (isset($_SESSION['post']->author) && $_SESSION['post']->author !== null ){echo htmlspecialchars($_SESSION['post']->author);}else{ echo htmlspecialchars($_SESSION['post']->pseudo);} ?></strong></p>
        <h4 class="text-center px-2"><?= htmlspecialchars($_SESSION['post']->title); ?></h4>
        <p class="text-center px-2"><?= htmlspecialchars($_SESSION['post']->content); ?></p>


            <!--Display or hides buttons-->
            <?php if ((!empty($_SESSION['user']) && $_SESSION['user']->pseudo === $_SESSION['post']->pseudo) || (isset($_SESSION['user']) && $_SESSION['user']->idRole === 1 && $_SESSION['user']->pseudo = 'admin') ){
                ?> <div class="d-flex ">
            <?php if (!isset($_SESSION['formUpdate']) || $_SESSION['formUpdate'] === false){
            ?>
                    <form action="index.php?action=updatePost" method="post" >
                        <button class="btn btn-outline-primary text-uppercase m-3"  type="submit">Modifier
                        </button>
                    </form>
            <?php } ?>
                    <form action="index.php?action=deletePost" method="post" >
                        <button class="btn btn-outline-primary text-uppercase m-3"  type="submit">Supprimer</button>
                    </form>
                </div> <?php

            } ?>
        </div>
    </section>


   <!--Add comment form-->
    <section class="w-75 m-auto">
        <div class=" mb-5 d-flex flex-column align-items-center ">
            <h3>Ajoutez un commentaire !</h3>
            <form action="index.php?action=addComment" method="post" class="w-75">
                <input type="hidden" name="csrf" value="<?= $csrf; ?>" required>
                <div class="mb-3">
                    <label for="content" class="form-label">Message</label>
                    <textarea class="form-control" id="content" name="content" style="height: 8rem" required></textarea>
                </div>
                <button type="submit" class="btn btn-warning">ENVOYER</button>
            </form>
        </div>
    </section>


    <!-- Display all comments-->
    <section class="my-5 pt-5 d-flex flex-column align-items-center">
        <?php
        if (!empty($_SESSION['comments'])){

        foreach ($_SESSION['comments'] as $value) {
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
                    par <strong><?= htmlspecialchars($value->pseudo); ?></strong></p>
                <p class="text-center px-2"><?= htmlspecialchars($value->content);
                    ?></p>

                <!--Display buttons for admin-->
                <?php if (isset($_SESSION['user']) && $_SESSION['user']->idRole === 1 && $_SESSION['user']->pseudo = 'admin') {
                    ?> <div class="d-flex ">

                        <form action="index.php?action=updateComment" method="post">
                            <button class="btn btn-outline-primary text-uppercase m-3"  type="submit">Modifier</button>
                        </form>
                        <form action="index.php?action=deleteComment" method="post">
                            <button class="btn btn-outline-primary text-uppercase m-3"  type="submit">Supprimer</button>
                        </form>

                    </div> <?php

                } ?>
            <?php
            }
        }else{
                echo '<h3>Pas de commentaire pour le moment !</h3>';
            }
        ?>
    </section>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>


