<?php
if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}

// --------------------------------

class Theme_Options extends Odin_Theme_Options {

    // -----------------------------------------------------------------------------

    public function __construct() {

        $this->cria_pagina_opcoes_tema();
    }

    // -----------------------------------------------------------------------------

    public function cria_pagina_opcoes_tema() {

    }

    // -----------------------------------------------------------------------------
}


new Theme_Options;
