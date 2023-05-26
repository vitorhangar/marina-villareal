<?php
/**
 * Banner
 */

if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}

$ctr_banner = new CTR_Content();
$banner = $ctr_banner->getBanners();

?>

<section class="banner">
    <div class="banner__box__content">
        <div class="banner__box__content__image">
            <div class="slider">
                <?php foreach($banner->gallery_images as $image): ?>
                    <img src="<?= $image->imageSrc; ?>" alt="">
                <?php endforeach; ?>
            </div>
        </div>
        <div class="banner-bottom">
            <?php foreach($banner->gallery_images as $image): ?>
                <button></button>
            <?php endforeach; ?>
        </div>
    </div>
</section>
