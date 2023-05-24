<?php
/**
 * Banner
 */

if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}

?>

<section class="banner">
    <div class="banner__content">
        <video autoplay muted loop>
            <source src="<?php echo theme_url('public/video/novo-hotel-villareal-caieiras-praia-central.mp4'); ?>" type="video/mp4">
        </video>
        <span>
            <svg>
                <use xlink:href="<?= theme_url('public/sprite/sprite.svg#icon__arrow__down'); ?>"/>
            </svg>
        </span>
    </div>
</section>
