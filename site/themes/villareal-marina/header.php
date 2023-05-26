<?php
/**
 * Header (Cabeçalho do site)
 */

if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}

$tm = new Controller_Scripts();
?>
<!DOCTYPE html>

<html class="no-js" lang="pt-br" dir="ltr">
    <?php inc( 'partials/head' ); ?>
</head>
<?php 

// Pegar a pagina sem incluir o "?"
$exp = explode('?', $_SERVER["REQUEST_URI"]);
$link = isset($exp[0]) ? $exp[0] : '';
$class = 'page-'.basename($link);

if( $page === 'single-treatments.php' ) {
    $class = 'single-page';
} else if($page === 'single.php') {
    $class = 'single';
}

?>

<body class="<?php echo $class; ?> overflow-hidden">

    <?php if($_SERVER['SERVER_NAME'] != 'localhost'): ?>
    <?php endif; ?>

    <?php $tm->add_tag_manager_in_body() ?>

    <div class="bg_load"></div>   

    <style>

        .overflow-hidden{
            overflow: hidden;
        }

        .bg_load{
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 999999;
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            /* height:280em; */
            margin: 0;
            padding: 0;
        }

    </style>

    <header class='header'>
        <?php inc('partials/header/main-header');?>
    </header>