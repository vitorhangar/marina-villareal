<?php
/**
 * Head - Tudo dentro da tag <head>
 */

if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}

$tm = new Controller_Scripts();
?>

<!-- Charset -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Marina Villareal</title>
<meta name="description" content="Aproveite  nossa promoção de reabertura do Hotel VillaReal marina em Guaratuba, diárias com 30% de desconto. Saiba mais agora mesmo!">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--Favicon IE 9 -->
<link rel="icon" type="image/x-icon" href="<?= theme_url( 'public/images/logo.png' ) ?>" />

<!-- Favicon Outros Navegadores -->
<link rel="shortcut icon" type="image/png" href="<?= theme_url( 'public/images/logo.png' ) ?>" /> 

<!-- Favicon iPhone -->
<link rel="apple-touch-icon" href="<?= theme_url( 'public/images/logo.png' ) ?>" />

<!-- Chrome, Firefox OS and Opera -->
<meta name="theme-color" content="#271302"/>

<!-- Safari -->
<meta name="apple-mobile-web-app-status-bar-style" content="#271302"/>

<?php //$tm->add_tag_manager_in_head() ?>

<?php if($_SERVER['SERVER_NAME'] != 'localhost'): ?>
<?php endif; ?>



<?php wp_head() ?>