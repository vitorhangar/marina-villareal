<?php
/**
 * About
 */

if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}

$ctr_content = new CTR_Content();
$about = $ctr_content->getAbout();

?>

<section class="about" id="marina">
    <div class="container">
        <div class="about__box" <?php if(!wp_is_mobile()){ echo 'data-aos="fade-up" data-aos-anchor-placement="top-center" data-aos-offset="-230" data-aos-duration="500"';} ?> >
            <div class="about-top">
                <div class="about__box__content">
                    <div class="about__box__content__text">
                        <h1><?= $about->title; ?></h1>
                        <?= wpautop($about->content); ?>
                    </div>
                    <div class="about__box__content__image">
                        <div class="slider">

                            <?php foreach($about->gallery_images as $image): ?>
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
                </div>
            </div>
            <div class="about-bottom">
                <div class="about__box__content__image">
                    <div class="slider">
                        <?php foreach($about->gallery_images2 as $image): ?>
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
                <div class="about-bottom-texts">
                    <h2><?= $about->title2; ?></h2>
                    <?= wpautop($about->content2); ?>
                </div>
            </div>
        </div>
    </div>
</section>