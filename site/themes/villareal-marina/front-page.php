<?php
/**
 * Home
 *
 */

if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}

session_start();

get_header(); ?>

    <main>

        <?php inc('partials/home/banner'); ?>
        <?php inc('partials/filter'); ?>
        <?php inc('partials/home/about'); ?>
        <?php inc('partials/home/estrutura'); ?>
        <?php inc('partials/home/details'); ?>
        <?php inc('partials/home/bedroom'); ?>
        <?php inc('partials/home/lazer'); ?>
        <?php inc('partials/home/eventos'); ?>
        <?php inc('partials/home/fotos'); ?>
        <?php inc('partials/home/precos'); ?>

    </main>

<?php get_footer(); ?>