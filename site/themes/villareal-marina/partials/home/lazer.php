<?php
/**
 * Details
 */

if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}

$ctr_content = new CTR_Content();
$detail = $ctr_content->getDetails();

?>

<section class="lazer" id="lazer">
    <div class="container">
        <div class="lazer__box">
            <div class="lazer__box__top" data-aos="fade-right" data-aos-duration="800">
                <div class="text-icon icon-coffe">
                    <span>
                        <svg>
                            <use xlink:href="<?= theme_url('public/sprite/sprite.svg#icon__lazer'); ?>"/>
                        </svg>
                    </span>
                    <h3><?= $detail->details_title_1; ?></h3>
                    <?= wpautop($detail->details_text_1); ?>
                </div>
                <div class="image zoom" style="background-image: url(<?= $detail->details_image_1->imageSrc; ?>);">
                    <a href="<?= $detail->details_image_1->imageSrc; ?>" data-lightbox="image-details" title="Ampliar Imagem" rel="lightbox">
                        <svg>
                            <use xlink:href="<?= theme_url('public/sprite/sprite.svg#icon__expand'); ?>"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="lazer__box__bottom" id="sustentabilidade" data-aos="fade-left" data-aos-duration="800">
                <div class="image zoom" style="background-image: url(<?= $detail->details_image_2->imageSrc; ?>);">
                    <a href="<?= $detail->details_image_2->imageSrc; ?>" data-lightbox="image-details" title="Ampliar Imagem" rel="lightbox">
                        <svg>
                            <use xlink:href="<?= theme_url('public/sprite/sprite.svg#icon__expand'); ?>"/>
                        </svg>
                    </a>
                </div>
                <div class="text-icon icon-beach">
                    <span>
                        <svg>
                            <use xlink:href="<?= theme_url('public/sprite/sprite.svg#icon__beach'); ?>"/>
                        </svg>
                    </span>
                    <h3><?= $detail->details_title_2; ?></h3>
                    <?= wpautop($detail->details_text_2); ?>
                </div>
            </div>
        </div>
    </div>
</section>