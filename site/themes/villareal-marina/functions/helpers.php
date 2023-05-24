<?php
if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}

// --------------------------------

if( ! defined( 'HELPERS_DIR' ) ) {
    define( 'HELPERS_DIR', FUNCTIONS_DIR . '/helpers' );
}

//Carrega todos os arquivos no diretório
foreach (glob( HELPERS_DIR ."/*.php") as $arquivo) {
	require_once  $arquivo;
}


