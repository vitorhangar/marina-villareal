<?php
/**
 * Bedroom
 */

if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}

$ctr_baia = new CTR_Content();
$baia = $ctr_baia->getBaia();

?>

<section class="baia" id="baia">
    <div class="container">
        <div class="baia__box" data-aos="fade-up" data-aos-anchor-placement="top-center" data-aos-offset="-230" data-aos-duration="500">
            <div class="baia__box__content">
                <div class="baia__box__content__text">
                    <h4><?= $baia->title; ?></h4>
                    <?= wpautop($baia->content); ?>
                </div>
                <div class="baia__box__content__image">
                    <div class="slider">

                        <?php foreach($baia->gallery_images as $image): ?>
                            <div class="item" style="background-image: url(<?= $image->imageSrc; ?>);">
                                <a href="<?= $image->imageSrc; ?>" data-lightbox="image-baia" title="Ampliar Imagem" rel="lightbox">
                                    <svg>
                                        <use xlink:href="<?= theme_url('public/sprite/sprite.svg#icon__expand'); ?>"/>
                                    </svg>
                                </a>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>