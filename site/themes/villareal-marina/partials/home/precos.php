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
    <img src="<?= theme_url('public/images/corda.png'); ?>" alt="corda">
    <div>
        <h2><?= $precos->title; ?></h2>
        <?= wpautop($precos->content); ?>
        <a href="#" class="button-tariff">Ver Preços</a>
    </div>
</section>