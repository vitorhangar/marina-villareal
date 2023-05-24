<?php
/**
 * Política de privacidade
 *
 */

if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}

get_header(); ?>

<?php inc('partials/breadcrumb'); ?>
<section class="privacy-policy">
    <div class="container">
        <?= apply_filters( 'the_content', get_the_content() ); ?>
    </div>
</section>

<?php get_footer(); ?>