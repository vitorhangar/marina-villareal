<?php
/**
 * Bedroom
 */

if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}

$ctr_precos = new CTR_Content();
$precos = $ctr_precos->getPrecos();

?>

<section class="precos" id="precos">
    <img class="corda" src="<?= theme_url('public/images/corda.png'); ?>" alt="corda">
    <div>
        <h6><?= $precos->title; ?></h6>
        <?= wpautop($precos->content); ?>
        <a href="<?= theme_url('public/images/PRECOS.pdf'); ?>" download class="button-tariff">Ver Preços</a>
    </div>
</section>