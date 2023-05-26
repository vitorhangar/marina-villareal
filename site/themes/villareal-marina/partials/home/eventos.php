<?php
/**
 * Bedroom
 */

if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}

$ctr_bedroom = new CTR_Bedroom();
$bedrooms = $ctr_bedroom->getBedroom();

?>

<section class="bedroom" id="eventos">
    <div class="container">
        <div class="bedroom__title">
            <span class="icon-bedroom">
                <svg>
                    <use xlink:href="<?= theme_url('public/sprite/sprite.svg#icon-eventos'); ?>"/>
                </svg>
            </span>
            <h4>Eventos</h4>
        </div>
        <div class="bedroom__change">
            <div class="container">
                <div class="bedroom__change__left">
                    <p>Confira os eventos que já sediamos</p>
                    <svg>
                        <use xlink:href="<?= theme_url('public/sprite/sprite.svg#icon__arrow__bedroom'); ?>"/>
                    </svg>
                </div>
                <div class="bedroom__change__right">
                    <p class="qtd_bedroom">1</p>
                    <span>/</span>
                    <p><?= count($bedrooms->posts); ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="bedroom__slider">
        <?php $cont = 1; ?>
        <?php foreach($bedrooms->posts as $bedroom): ?>
            <div class="item" data-current="<?= $cont; ?>">
                <div class="image-slider">
                    <?php $cont_images = 1; ?>
                    <?php foreach($bedroom->gallery_images as $img_bedroom): ?>
                        <div class="image" style="background-image: url('<?= $img_bedroom->imageSrc; ?>')">
                            <div class="background">
                                <a href="<?= $img_bedroom->imageSrc; ?>" data-lightbox="<?= $bedroom->post_title; ?>" title="Ampliar Imagem" rel="lightbox">
                                    <svg>
                                        <use xlink:href="<?= theme_url('public/sprite/sprite.svg#icon__expand'); ?>"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <?php $cont_images++; ?>
                    <?php endforeach; ?>
                </div>
                <div class="content">
                    <h5><?= $bedroom->post_title; ?></h5>
                </div>
            </div>
            <?php $cont++; ?>
        <?php endforeach; ?>
    </div>
</section>