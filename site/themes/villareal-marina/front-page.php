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
        <?php inc('partials/home/beach'); ?>
        <?php inc('partials/home/details'); ?>
        <?php inc('partials/home/bedroom'); ?>

    </main>

<?php get_footer(); ?>