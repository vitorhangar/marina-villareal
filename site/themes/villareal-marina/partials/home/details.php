<?php
/**
 * Bedroom
 */

if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}

$ctr_seguranca = new CTR_Content();
$seguranca = $ctr_seguranca->getSegurancaa();

?>

<section class="details" id="details">
    <div class="container">
        <div class="details__box" <?php if(!wp_is_mobile()){ echo 'data-aos="fade-up" data-aos-anchor-placement="top-center" data-aos-offset="-230" data-aos-duration="500"';} ?> >
            <div class="details-top">
                <div class="details__box__content">
                    <div class="details__box__content__image">
                        <div class="slider">

                            <?php foreach($seguranca->gallery_images as $image): ?>
                                <div class="item" style="background-image: url(<?= $image->imageSrc; ?>);">
                                    <a href="<?= $image->imageSrc; ?>" data-lightbox="image-hotel" title="Ampliar Imagem" rel="lightbox">
                                        <svg>
                                            <use xlink:href="<?= theme_url('public/sprite/sprite.svg#icon__expand'); ?>"/>
                                        </svg>
                                    </a>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                    <div class="details__box__content__text">
                        <div>
                            <h2><?= $seguranca->title; ?></h2>
                            <?= wpautop($seguranca->content); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>