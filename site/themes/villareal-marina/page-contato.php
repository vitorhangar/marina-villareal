<?php
/**
 * Contato
 *
 */

if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}

$ctr_content = new CTR_Content();
$info_site = $ctr_content->getInfos();

$info_contact = $ctr_content->getInfosPageContact();

get_header(); ?>

<section class="contact">
    <div class="contact__content">
        <div class="contact__content__title">
            <div class="container">
                <?php inc('partials/breadcrumb'); ?>
                <h1><?= $info_contact->title; ?></h1>
                <p class="subtitle"><?= $info_contact->content; ?></p>
                <ul class="contact__content__title__dados">
                    <li>
                        <a href="<?= $info_site->adress_link; ?>" target="_blank">
                            <svg>
                                <use xlink:href="<?= theme_url('public/sprite/sprite.svg#icon__pin'); ?>"/>
                            </svg>    
                            <p><?= $info_site->adress; ?></p>
                        </a>
                    </li>
                    <li>
                        <a href="tel:<?= str_replace(array('(', ')', '-', ' ', '+'), '', $info_site->telefone);?>" target="_blank" class="click-telefone">
                            <svg>
                                <use xlink:href="<?= theme_url('public/sprite/sprite.svg#icon__phone'); ?>"/>
                            </svg>
                            <p><?= $info_site->telefone; ?></p>
                        </a>
                    </li>
                    <li>
                        <a href="mailto:<?= $info_site->email; ?>">
                            <svg>
                                <use xlink:href="<?= theme_url('public/sprite/sprite.svg#icon__email'); ?>"/>
                            </svg>
                            <p><?= $info_site->email; ?></p>
                        </a>
                    </li>
                    <li class="networks">
                        <p>Siga a gente nas Redes Sociais:</p>
                        <a href="<?= $info_site->facebook; ?>" target="_blank">
                            <svg>
                                <use xlink:href="<?= theme_url('public/sprite/sprite.svg#icon__facebook'); ?>"/>
                            </svg>
                        </a>
                        <a href="<?= $info_site->instagram; ?>" target="_blank">
                            <svg>
                                <use xlink:href="<?= theme_url('public/sprite/sprite.svg#icon__instagram'); ?>"/>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="contact__content__form">
            <div class="container">
                <?= do_shortcode('[contact-form-7 id="5" title="Contato"]'); ?>
            </div>
        </div>
    </div>
</section>

<?php inc('partials/filter'); ?>

<?php get_footer(); ?>