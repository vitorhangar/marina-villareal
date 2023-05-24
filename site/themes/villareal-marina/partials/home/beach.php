<?php
/**
 * Beach
 */

if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}

$ctr_content = new CTR_Content();
$beach = $ctr_content->getBeach();

?>

<section class="beach" id="beach">
    <div class="container">
        <div class="beach__box" data-aos="fade-up" data-aos-anchor-placement="top-center" data-aos-offset="-230" data-aos-duration="500">
            <div class="beach__box__content">
                <div class="beach__box__content__image">
                    <div class="slider">

                        <?php foreach($beach->gallery_images as $image): ?>
                            <div class="item" style="background-image: url(<?= $image->imageSrc; ?>);">
                                <a href="<?= $image->imageSrc; ?>" data-lightbox="image-beach" title="Ampliar Imagem" rel="lightbox">
                                    <svg>
                                        <use xlink:href="<?= theme_url('public/sprite/sprite.svg#icon__expand'); ?>"/>
                                    </svg>
                                </a>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
                <div class="beach__box__content__text">
                    <h2><?= $beach->title; ?></h2>
                    <?= wpautop($beach->content); ?>
                </div>
            </div>
        </div>
    </div>
</section>