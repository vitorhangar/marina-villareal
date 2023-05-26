<?php
/**
 * Bedroom
 */

if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}

$ctr_fotos = new CTR_Content();
$fotos = $ctr_fotos->getFotos();

?>

<section class="fotos" id="fotos">
    <div class="container">
        <div class="fotos__title">
            <span class="icon-fotos">
                <svg>
                    <use xlink:href="<?= theme_url('public/sprite/sprite.svg#icon-fotos'); ?>"/>
                </svg>
            </span>
            <h4>Fotos</h4>
        </div>
        <div class="fotos__change">
            <div class="container">
                <div class="fotos__change__left">
                    <p>Confira uma galeria de fotos da nossa Marina</p>
                    <svg>
                        <use xlink:href="<?= theme_url('public/sprite/sprite.svg#icon__arrow__fotos'); ?>"/>
                    </svg>
                </div>
                <div class="fotos__change__right">
                    <p class="qtd_fotos">1</p>
                    <span>/</span>
                    <p><?= count($fotos->gallery_images); ?></p>
                </div>
            </div>
        </div>
        <div class="fotos__slider">
        <?php $cont_images = 1; ?>
        <?php foreach($fotos->gallery_images as $image): ?>
            <div class="item" data-current="<?= $cont_images; ?>">
                <div class="image-slider">
                        <div class="image" style="background-image: url('<?= $image->imageSrc; ?>')">
                            <div class="background">
                                <a href="<?= $image->imageSrc; ?>" data-lightbox="Fotos" title="Ampliar Imagem" rel="lightbox">
                                    <svg>
                                        <use xlink:href="<?= theme_url('public/sprite/sprite.svg#icon__expand'); ?>"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                </div>
            </div>
            <?php $cont_images++; ?>
        <?php endforeach; ?>
    </div>
    </div>
</section>