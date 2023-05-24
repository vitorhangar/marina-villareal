<?php
if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}

// --------------------------------

if( ! defined( 'WIDGETS_DIR' ) ) {
    define( 'WIDGETS_DIR', FUNCTIONS_DIR . '/widgets' );
}

//Carrega todos os arquivos no diretório
foreach (glob( WIDGETS_DIR ."/*.php") as $arquivo) {
    require_once  $arquivo;
}
