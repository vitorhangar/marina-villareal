<?php
/**
 * Breadcrumb
 */

if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}

?>

<div class="breadcrumb <?php if(!is_page('home')){echo 'breadcrumb-block';}else{echo 'breadcrumb-none';} ?>">
    <div class="container">
        <a href="<?= site_url(); ?>" title="Home">
			<svg>
				<use xlink:href="<?= theme_url('public/sprite/sprite.svg#icon__home'); ?>"/>
			</svg>
		</a>
        <svg>
			<use xlink:href="<?= theme_url('public/sprite/sprite.svg#icon__arrow__breadcrumb'); ?>"/>
		</svg>
        <a href="<?= theme_url().'/'.get_queried_object()->post_name; ?>" title="<?= get_queried_object()->post_title; ?>"><?= get_queried_object()->post_title; ?></a>
    </div>
</div>