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
                    <?php if($image->imageSrc != ''): ?>
                        <img src="<?= $image->imageSrc; ?>" alt="banner">
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
