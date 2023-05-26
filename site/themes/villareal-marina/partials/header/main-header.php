<?php
/**
 * Header - Main Header
 */

if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}

$ctr_content = new CTR_Content();
$info_site = $ctr_content->getInfos();

?>

<div class="main-header <?php if(!is_page('home')){echo 'main-header-normal';} ?>">
	<div class="container">
		<div class="main-logo">
			<a href="<?php echo get_site_url(); ?>" title="VillaReal Marina">
				<img src="<?= theme_url('public/images/logo-blue.png'); ?>" alt="logo">
			</a>
		</div>
		
		<div class="main-header__menu">

			<div class="ham">
				<div class="ham__item"></div>
				<div class="ham__item"></div>
				<div class="ham__item"></div>
			</div>

			<div class="main-menu">
				<div class="btn-header">
				<?php 
						$menu = wp_get_nav_menu_items('menu-portugues'); 
						$cont = 1;
						$data_link = ['/#marina', '/#lazer', '/#sustentabilidade', '/#baia', '/#eventos', '/#fotos', '/#precos'];
					?>

					<?php foreach($menu as $item): ?>
						<?php												
							if(count($menu) == $cont): ?>
							<a href="<?= $item->url; ?>" class="link-menu" rel="noopener"><?= $item->title; ?></a>
						<?php else: ?>
							<a href="<?= get_site_url(); ?><?= $data_link[$cont - 1]; ?>" id="#<?= $data_link[$cont - 1]; ?>-link" class="link-menu" rel="noopener"><?= $item->title; ?></a>
						<?php endif;?>
					<?php 
						$cont++; 
						endforeach;
					?>
					<!-- <a href="tel:+5541999745731" class="link-menu phone click-telefone">
						<svg>
							<use xlink:href="<?//= theme_url('public/sprite/sprite.svg#icon__phone'); ?>"/>
						</svg>
						<p>+55 (41) 9 9974-5731</p>
					</a>				 -->
					<div class="networks">
						<a href="<?= $info_site->facebook; ?>" class="link-menu facebook" target="_blank">
							<svg>
								<use xlink:href="<?= theme_url('public/sprite/sprite.svg#icon__facebook'); ?>"/>
							</svg>
						</a>
						<a href="<?= $info_site->instagram; ?>" class="link-menu instagram" target="_blank">
							<svg>
								<use xlink:href="<?= theme_url('public/sprite/sprite.svg#icon__instagram'); ?>"/>
							</svg>
						</a>
					</div>
				</div>
		</div>
	</div>
</div>