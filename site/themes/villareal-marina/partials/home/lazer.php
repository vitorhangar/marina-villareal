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
                    <div class="icon-container">
                        <svg width="75" height="75" viewBox="0 0 75 75" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.1389 18.8095C20.1389 8.42132 28.5602 0 38.9484 0H56.1905C66.5787 0 75 8.42131 75 18.8095V36.0516C75 46.4398 66.5787 54.8611 56.1905 54.8611H38.9484C28.5602 54.8611 20.1389 46.4398 20.1389 36.0516V18.8095Z" fill="#1B4B63"/>
                            <path d="M51.6493 65.162H56.5683V70.081H2.45947V65.162H7.37845V23.3507C7.37845 21.9924 8.47962 20.8912 9.83794 20.8912H49.1898C50.5482 20.8912 51.6493 21.9924 51.6493 23.3507V65.162ZM46.7303 65.162V25.8102H12.2974V65.162H46.7303ZM19.6759 43.0266H27.0544V47.9456H19.6759V43.0266ZM19.6759 33.1887H27.0544V38.1076H19.6759V33.1887ZM19.6759 52.8646H27.0544V57.7836H19.6759V52.8646ZM31.9734 52.8646H39.3518V57.7836H31.9734V52.8646ZM31.9734 43.0266H39.3518V47.9456H31.9734V43.0266ZM31.9734 33.1887H39.3518V38.1076H31.9734V33.1887Z" fill="#0F2B39"/>
                        </svg>
                    </div>
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
                    <div class="icon-container">
                        <svg width="80" height="61" viewBox="0 0 80 61" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="31.0078" width="48.9922" height="48.19" rx="18.8095" fill="#1B4B63"/>
                            <path d="M13.174 15.6313C20.8389 15.6313 27.1938 21.1485 28.3579 28.3659C30.9389 25.8369 34.4998 24.273 38.4322 24.273H48.316V29.674C48.316 37.4297 41.9243 43.7167 34.0395 43.7167H28.5485V54.5188H24.1558V37.2355H19.7631C11.2719 37.2355 4.38843 30.4647 4.38843 22.1125V15.6313H13.174ZM43.9232 28.5938H38.4322C32.9738 28.5938 28.5485 32.9464 28.5485 38.3157V39.3959H34.0395C39.4982 39.3959 43.9232 35.0433 43.9232 29.674V28.5938ZM13.174 19.9521H8.78119V22.1125C8.78119 28.0784 13.6979 32.9146 19.7631 32.9146H24.1558V30.7542C24.1558 24.7884 19.2391 19.9521 13.174 19.9521Z" fill="#0F2B39"/>
                        </svg>
                    </div>
                    <h3><?= $detail->details_title_2; ?></h3>
                    <?= wpautop($detail->details_text_2); ?>
                </div>
            </div>
        </div>
    </div>
</section>