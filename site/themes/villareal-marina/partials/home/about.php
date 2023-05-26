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
                <div class="about-bottom-texts">
                    <h2>Infraestrutura</h2>
                    <p>Com 23 vagas molhadas para atracação de embarcações de até 100 pés, sendo 14 vagas de 30 a 100 pés em flutuante anexo ao píer e 9 vagas em poitas para até 70 pés, em sistema de locação de diárias ou mensalistas. Além disso, possui segurança monitorada 24 horas, acesso à internet, água potável e energia elétrica, loja de conveniência e bomboniere. O posto de combustível fornecerá diesel marítimo e gasolina, acessível a todos os navegantes da baia Babitonga</p>
                </div>
            </div>
        </div>
    </div>
</section>