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

<section class="eventos" id="eventos">
    <div class="container">
        <div class="eventos__title">
            <span class="icon-eventos">
                <svg width="86" height="70" viewBox="0 0 86 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="31.9419" width="53.6893" height="53.6893" rx="18.8095" fill="#1B4B63"/>
                    <path d="M21.6627 14.64V19.4539H36.1044V14.64H40.9183V19.4539H50.5462C51.8755 19.4539 52.9531 20.5316 52.9531 21.8609V60.3722C52.9531 61.7016 51.8755 62.7792 50.5462 62.7792H7.22092C5.89161 62.7792 4.81396 61.7016 4.81396 60.3722V21.8609C4.81396 20.5316 5.89161 19.4539 7.22092 19.4539H16.8488V14.64H21.6627ZM48.1392 38.7096H9.62788V57.9652H48.1392V38.7096ZM26.4766 43.5235V53.1513H14.4418V43.5235H26.4766ZM16.8488 24.2678H9.62788V33.8957H48.1392V24.2678H40.9183V29.0818H36.1044V24.2678H21.6627V29.0818H16.8488V24.2678Z" fill="#95C4DC"/>
                </svg>
            </span>
            <h4>Eventos</h4>
        </div>
        <div class="eventos__change">
            <div class="container">
                <div class="eventos__change__left">
                    <p>Confira os eventos que já sediamos</p>
                    <svg>
                        <use xlink:href="<?= theme_url('public/sprite/sprite.svg#icon__arrow__bedroom'); ?>"/>
                    </svg>
                </div>
                <div class="eventos__change__right">
                    <p class="qtd_eventos">1</p>
                    <span>/</span>
                    <p><?= count($bedrooms->posts); ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="eventos__slider">
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