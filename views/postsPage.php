<?php $title = 'Posts'; ?>
<?php $H1 = 'MES DERNIERS POSTS' ?>

<?php ob_start(); ?>

    <section>
        <?= 'ok' ?>
    </section>

<?php $content = ob_get_clean() ?>

<?php require('layout.php') ?>