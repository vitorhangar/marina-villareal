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

<section class="bedroom" id="bedroom">
    <div class="container">
        <div class="bedroom__title">
            <span class="icon-bedroom">
                <svg>
                    <use xlink:href="<?= theme_url('public/sprite/sprite.svg#icon__bedroom'); ?>"/>
                </svg>
            </span>
            <h4>Confira os Quartos</h4>
        </div>
        <a href="https://hbook.hsystem.com.br/Booking?companyId=5f514164ab41d42368a1007c" target="_blank" class="button-tariff">Ver Tarifas</a>
        <div class="bedroom__change">
            <div class="container">
                <div class="bedroom__change__left">
                    <p>Mude de quarto utilizando as setas ao lado</p>
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
                    <span class="icon-line"></span>
                    <?php if($bedroom->qty_couple_bed || $bedroom->qty_single_bed): ?>
                        <div class="beds">
                            <p>Opções Disponíveis</p>
                            <div class="beds-box">
                                <?php if($bedroom->qty_couple_bed): ?>
                                    <div class="couple_bed">
                                        <svg>
                                            <use xlink:href="<?= theme_url('public/sprite/sprite.svg#icon__couple__bed'); ?>"/>
                                        </svg>
                                        <span><?php if($bedroom->qty_couple_bed > 1){echo $bedroom->qty_couple_bed.' camas de casal'; }else{echo $bedroom->qty_couple_bed.' cama de casal'; }?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if($bedroom->qty_single_bed): ?>
                                    <div class="divider"></div>
                                    <div class="single_bed">
                                        <svg>
                                            <use xlink:href="<?= theme_url('public/sprite/sprite.svg#icon__single__bed'); ?>"/>
                                        </svg>
                                        <span><?php if($bedroom->qty_single_bed > 1){echo $bedroom->qty_single_bed.' camas de solteiro '; }else{echo $bedroom->qty_single_bed.' cama de solteiro'; }?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <span class="icon-line"></span>
                    <div class="atributes">
                        <?php foreach($bedroom->atributes as $image_atribute): ?>
                            <div class="atribute">
                                <figure>
                                    <img src="<?= $image_atribute['image']->imageSrc; ?>" alt="Hotel VillaReal">
                                </figure>
                                <p><?= $image_atribute['name']; ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php $cont++; ?>
        <?php endforeach; ?>
    </div>
    <a href="https://hbook.hsystem.com.br/Booking?companyId=5f514164ab41d42368a1007c" target="_blank" class="button-tariff">Ver Tarifas</a>
</section>