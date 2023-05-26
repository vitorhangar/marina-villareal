<?php
/**
 * Footer - Main Footer
 */

if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}

$ctr_content = new CTR_Content();
$info_site = $ctr_content->getInfos();

?>

<footer> 
    <?= $info_site->adress_link_embed; ?>
    <div class="footer-top">
        <img class="footer-bg" src="<?= theme_url('public/images/footer-bg.png'); ?>" alt="image">  
        <div class="container">
            <div class="footer-top__content">
                <a href="" class="footer-top__content__logo" titlse="VillaReal Marina">
                    <img src="<?= theme_url('public/images/logo.png'); ?>" alt="logo">
                </a>

                <?php 
                    $menu = wp_get_nav_menu_items('menu-portugues'); 
                    $cont = 1;
                    $data_link = ['about', 'beach', 'bedroom'];
                ?>

                <ul class="footer-top__content__nav-bar">
                                      
                    <?php foreach($menu as $item): ?>
						<?php												
							if(count($menu) == $cont): ?>
                            <li>
							    <a href="<?= $item->url; ?>" data-link="<?= $data_link[$cont - 1]; ?>" rel="noopener"><span><?= $item->title; ?></span></a>
                            </li>
						<?php else: ?>
                            <li>
                                <a href="<?= get_site_url(); ?>/#<?= $data_link[$cont - 1]; ?>" id="#<?= $data_link[$cont - 1]; ?>-link" rel="noopener"><span><?= $item->title; ?></span></a>
                            </li>
						<?php endif;?>
					<?php 
						$cont++; 
						endforeach;
					?>
                    <li>
                        <a href="<?= theme_url('politica-de-privacidade'); ?>" rel="noopener"><span>Política de Privacidade</span></a>
                    </li>
                </ul>
                <ul class="footer-top__content__dados">
                    <li>
                        <a href="<?= $info_site->adress_link; ?>" target="_blank">
                            <svg>
                                <use xlink:href="<?= theme_url('public/sprite/sprite.svg#icon__pin'); ?>"/>
                            </svg>    
                            <p><?= $info_site->adress; ?></p>
                        </a>
                    </li>
                    <li>
                        <a href="tel:<?= str_replace(array('(', ')', '-', ' ', '+'), '', $info_site->telefone);?>" class="click-telefone">
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
    </div>
    <div class="footer-btn">
        <!-- <a href="https://wa.me/5541999745731?text=Ol%C3%A1%21+Entrei+no+*site*+Hotel+VillaReal+marina+e+gostaria+de+mais+informa%C3%A7%C3%B5es.+%E2%9E%A1" class="btn-whats click-whatsapp" target="_blank" title="Whatsapp" rel="noopener" class="btn-whats">
            <svg>
                <use xlink:href="<?//= theme_url('public/sprite/sprite.svg#icon__whats'); ?>"/>
            </svg>
        </a> -->
        <a rel="noopener" class="btn-back-top">
            <svg>
                <use xlink:href="<?= theme_url('public/sprite/sprite.svg#icon__arrow__up'); ?>"/>
            </svg>
        </a>
    </div>
    <div class="reserve-mobile">
        <a href="https://reservas.desbravador.com.br/reservas/rol1/index.php?token=rBwDlvf77mDLIME3hhEa%2BzCYPeSa7Umy%2FJqYO1QzRpNUuCa5y91n4drbDZ6U3lhn62aIwJ4i9tYnD8OULrSFJvOeJAT7jNcF58o0RMzzDMESddepZLg4rBaCFvOW7KuC" class="click-reserva-villareal-marina" target="_blank" rel="noopener">Reservar Agora</a>
    </div>
</footer>


