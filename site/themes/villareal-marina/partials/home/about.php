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

<section class="about" id="about">
    <div class="container">
        <div class="about__box" <?php if(!wp_is_mobile()){ echo 'data-aos="fade-up" data-aos-anchor-placement="top-center" data-aos-offset="-230" data-aos-duration="500"';} ?> >
            <div class="about__box__title">
                <h1><?= $about->title; ?></h1>
            </div>
            <div class="about__box__content">
                <div class="about__box__content__text">
                    <?= wpautop($about->content); ?>
                    <div class="tour">
                        <a href="https://mpembed.com/show/?m=fh2VZGhKrnB&logo=https://instagram.fbfh3-1.fna.fbcdn.net/vp/ccb0fac1740a0cef494d3f91e0ef172c/5CA74032/t51.2885-19/s150x150/16583220_329954444068524_7051854494895702016_a.jpg%27" target="_blank">
                            <img src="<?= theme_url('public/images/bg-tour.png'); ?>" alt="Hotel VillaReal marina">
                            <span>Tour Virtual 360º</span>
                        </a>
                    </div>
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
    </div>
</section>