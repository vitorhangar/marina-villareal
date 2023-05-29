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
                <svg width="87" height="71" viewBox="0 0 87 71" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="32.5437" width="54.4563" height="54.4563" rx="18.8095" fill="#1B4B63"/>
                    <path d="M7.44964 63.6759C6.1124 63.6759 5.02832 62.5897 5.02832 61.2506V22.1569C5.02832 20.8175 6.13989 19.7317 7.44964 19.7317H51.4339C52.7712 19.7317 53.8552 20.818 53.8552 22.1569V61.2506C53.8552 62.59 52.7436 63.6759 51.4339 63.6759H7.44964ZM48.9725 49.0278V24.6144H9.91101V58.7932L34.3244 34.3797L48.9725 49.0278ZM48.9725 55.9329L34.3244 41.2848L16.8162 58.7932H48.9725V55.9329ZM19.6764 39.2624C16.9797 39.2624 14.7937 37.0765 14.7937 34.3797C14.7937 31.6831 16.9797 29.4971 19.6764 29.4971C22.373 29.4971 24.5591 31.6831 24.5591 34.3797C24.5591 37.0765 22.373 39.2624 19.6764 39.2624Z" fill="#0F2B39"/>
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